<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_list extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function test()
	{
		echo "test";
	}
	public function index()
	{
		$this->db->select("*");
		//$this->db->where()
		$data["server_list"] = $this->db->get("server_list")->result();
		$data["server_list_data"] = array();
		$data["used_port_list"] = array();
		foreach ($data["server_list"] as $value)
		{
			$this->db->select("*");
			$this->db->where("belong", $value->id);
			$data["port_list"][$value->id] = $this->db->get("port_list")->result();

		}

		$this->db->select("*");
		$this->db->order_by("dst_port", "asc");
		$data["used_port_list"] = $this->db->get("port_list")->result();


		$this->load->view('server_list', $data);
	}
	public function add()
	{
		$tmp = array("belong" => $_POST["belong"], "src_port" => "0", "dst_port" => "0");
		$this->db->insert("port_list", $tmp);
	}
	public function remove()
	{
		echo $_POST["id"];
		$this->db->where("id", $_POST["id"]);
		$this->db->delete("port_list");
	}
	public function update_general()
	{
		echo $_POST["id"]." ".$_POST["target"]." ".$_POST["val"];
		$tmp[$_POST["target"]] = $_POST["val"];
		$this->db->where("id", $_POST["id"]);
		$this->db->update("server_list", $tmp);
	}
	public function update()
	{
		echo $_POST["type"]." ".$_POST["target"]." ".$_POST["val"];
		$tmp[$_POST["type"]."_port"] = $_POST["val"];
		$this->db->select("*");
		$this->db->where("id", $_POST["target"]);
		$this->db->update("port_list", $tmp);
	}

}
