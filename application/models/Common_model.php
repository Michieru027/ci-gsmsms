<?php
//Implemented by Jerome.
class Common_model extends CI_Model{

    public function GetSingleDataFromSingleTable($select,$tablename,$where = ''){
        $this->db->select($select);
        $this->db->from($tablename);

        if(!empty($where)){
            $this->db->where($where);
        }

        $query  =   $this->db->get();
        return $query->row_array();
    }

    public function GetDataFromSingleTable($select,$tablename,$where = '', $limit = 0,$offset = 0,$order = '', $group_by = '', $count = false){
        $this->db->select($select);
        $this->db->from($tablename);

        if(!empty($where)){
            $this->db->where($where);
        }

        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }

        if(!empty($order)){
            $this->db->order_by($order);
        }

        if((int)$limit + (int)$offset == 0){
//            $this->db->limit(10);
        }else{
            $this->db->limit($limit,$offset);
        }

        $query  =   $this->db->get();

        if($count){
            return $query->num_rows();
        }else{
            return $query->result_array();
        }
    }

    public function GetDataWithJoin($select,$tablename,$where,$join_table,$join_expression,$join_type = "left",$limit = 0,$offset = 0, $order = ''){
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->join($join_table,$join_expression,$join_type);

        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        if ($limit+$offset == 0) {
//            $this->db->limit($limit);
        } else {
            $this->db->limit($limit,$offset);
        }

        $query  =   $this->db->get();
        return $query->result_array();
    }

    public function InsertDataToSingleTable($tablename,$insert){
        $this->db->insert($tablename,$insert);

        return $this->db->insert_id();
    }

    public function UpdateDataFromSingleTable($tablename,$update,$where){
        $this->db->where($where);
        $this->db->update($tablename,$update);

        return $this->db->affected_rows();
    }

    public function DeleteDataFromSingleTable($tablename,$where){
        $this->db->delete($tablename,$where);
        return $this->db->affected_rows();
    }

    public function ProcessDataQuery($query){
        $query  =   $this->db->query($query);
        return $query->result_array();
    }

}