<?php

/**
 * @property Market_model $Market_model
 * @property Product_Price_model $Product_Price_model
 * @property Product_Category_model $Product_Category_model
 * @property Category_model $Category_model
 */
class Product_model extends CI_Model
{
    protected $table = "products";

    function __construct()
    {
        parent::__construct();
    }

    public function pagination($num_rows)
    {
        $showingCount = $this->input->get("show_count");
        if (!isset($showingCount)) $showingCount = 10;

        $prePage = $this->input->get('page');
        if (!isset($prePage)) $prePage = 1;
        if (isset($prePage) && $prePage != 0) {
            $offset = abs(((($prePage - 1) * $showingCount) + 1 - 1));
        } else {
            $prePage = 1;
            $offset = 0;
        }

        $pagination = new stdClass();
        $pagination->totalResultCount = $num_rows;
        $pagination->currentPage = ($prePage === 0) ? 1 : $prePage;
        $pagination->allPages = ceil($num_rows / $showingCount);
        $pagination->offset = $offset;
        $pagination->ResultCountPerPage = $showingCount;
        $pagination->status = ($pagination->currentPage <= $pagination->allPages);
        $pagination->hasPagination = ($num_rows > $showingCount);
        return $pagination;
    }


    function getProductsQuery(array $config)
    {
        $this->db->select("name,cover,user_id,$this->table.id as product_id,created_at");

        if (isset($config["subCategoryId"], $config["categoryId"]) OR isset($config["categoryId"])) {
            $condition = "AND category_id = {$config["categoryId"]}";
        } elseif (isset($config["subCategoryId"])) {
            $condition = "AND subcategory_id = {$config["subCategoryId"]}";
        } else {
            $condition = "";
        }

        if (isset($config["subCategoryId"]) OR isset($config["categoryId"])) {
            $this->db->join("product_category", "product_category.product_id = $this->table.id $condition");
        }

        $this->db->where("is_active", 1);
        $this->db->like("name", $config["search"]);
        if (isset($config["sort"])) $this->db->order_by("created_at", $config["sort"]);
        return $this->db->get($this->table, $config["limit"], $config["offset"]);
    }

    function getProducts($searchText = null, $sort = null, $categoryID = null, $subCategoryID = null)
    {

        $totalResult = $this->getProductsQuery([
            "limit" => null,
            "offset" => null,
            "search" => $searchText,
            "sort" => $sort,
            "categoryId" => $categoryID,
            "subCategoryId" => $subCategoryID,
        ])->num_rows();

        $paginate = $this->pagination($totalResult);
        $data = [];
        if ($paginate->status === false) return $data;

        $products = $this->getProductsQuery([
            "limit" => $paginate->ResultCountPerPage,
            "offset" => $paginate->offset,
            "search" => $searchText,
            "sort" => $sort,
            "categoryId" => $categoryID,
            "subCategoryId" => $subCategoryID,
        ])->result();

        foreach ($products as $product) {
            $product->cover = base_url("upload/products/") . $product->cover;
            $product->cover_exact = $product->cover;
        }
        return ["products" => $products, "pagination" => $paginate];
    }

    function getProductsByIds(array $ids)
    {
        $this->db->where_in("id", $ids);
        return $this->db->get($this->table)->result();
    }

    public function newProduct(array $data)
    {
        $data["created_at"] = date("Y-m-d H:i:s");
        $this->db->set($data);
        return ($this->db->insert($this->table)) ? $this->db->insert_id() : false;
    }

    public function updateProduct(int $id, array $data)
    {
        $data["updated_at"] = date("Y-m-d H:i:s");
        return $this->db->update($this->table, $data, ["id" => $id]);
    }

    public function getProduct($id)
    {
        $this->load->model("Product_Category_model");
        $this->load->model("Category_model");
        $productCat_table = $this->Product_Category_model->table;
        $cat_table = $this->Category_model->table;
        return $this->db->select("$this->table.*,$productCat_table.category_id,$cat_table.title as category_title")->from($this->table)
            ->join($productCat_table, "$productCat_table.product_id = $this->table.id", "left")
            ->join($cat_table, "$cat_table.id = $productCat_table.category_id", "left")
            ->where("$this->table.id", $id)
            ->get()->result();
    }

    public function getProductCover($id)
    {
        $this->db->where("id", $id);
        $this->db->select("cover");
        $result = $this->db->get($this->table, 1);
        return $result->num_rows() === 1 ? $result->result()[0]->cover : null;
    }

    public function getMarketProducts($marketId)
    {
//        $marketTable = $this->Market_model->table;
        $this->load->model("Product_Price_model");
        $ProductPriceTable = $this->Product_Price_model->table;
        return $this->db->select()->from($this->table)
            ->join($ProductPriceTable, "$ProductPriceTable.product_id = $this->table.id AND $ProductPriceTable.market_id = $marketId")
            ->get()->result();
    }

    public function delete($id)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->table, array(
            "is_deleted" => 1,
            "is_active" => 0,
        ));
    }

    public function totalCount()
    {
        return $this->db->where(["is_active" => 1, "is_deleted" => 0])->get($this->table)->num_rows();
    }

    public function getSubCategoryProducts($id, $search = null)
    {
        $this->db->select()
            ->from($this->table)
            ->join("product_category", "product_category.product_id = $this->table.id")
            ->where("product_category.subcategory_id", $id);
        $this->db->like("$this->table.name", $search);
        return $this->db->get()->result();
    }
}