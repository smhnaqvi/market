<?php


class Setting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    protected $table = "setting";
    public $types = array("video", "image", "text");

    function store(string $type, string $value, string $position, string $page)
    {
        if (!in_array($type, $this->types)) {
            return false;
        }
        $this->db->set("type", $type);
        $this->db->set("value", $value);
        $this->db->set("position", $position);
        $this->db->set("page", $page);
        return $this->db->insert($this->table);
    }

    public function getSetting($type, $position, $page)
    {
        $this->db->where(array(
            "page" => $page,
            "type" => $type,
            "position" => $position,
        ));
        $this->db->where("is_deleted", 0);
        return $this->db->get($this->table)->result();
    }


    function getData($id)
    {
        $this->db->where("id", $id);
        $this->db->where("is_deleted", 0);
        $result = $this->db->get($this->table, 1);
        return ($result->num_rows() === 1) ? $result->result()[0] : [];
    }

    function destroy($id)
    {
        $this->db->where(["id" => $id]);
        return $this->db->update($this->table, ["is_deleted" => 1]);
    }

}