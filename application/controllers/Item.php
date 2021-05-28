<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Item extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        header("Content-type: application/json");
    }

    function index_get() {
        $id = $this->get('id_item');
        if ($id == '') {
            // $mhs = $this->db->get('tbl_mhs')->result();
            $item = $this->m_data->master_item()->result();
        } else {
            $this->db->where('id_item', $id);
            $item = $this->m_data->master_item()->result();
        }

        $dataReturn = array();
        foreach ($item as $key => $value) {
            $a = $value->kode_jadi;  //
            $b = $value->nama_item;  //
            $c = $value->tipe_sn;  //
            $d = $value->serial_number;  //
            $e = $value->tipe_kategori; //
            $f = $value->nama_dept;  //
            $g = $value->nama_master_tipe; //
            $h = $value->sub_code; //
            $i = $value->nama_sub; //
            $j = $value->nama_brand; //
            $k = $value->warna; //
            $l = $value->keterangan; // 
            $m = $value->tahun_pembelian; //

            if ($c == 'sn') {
                $sn = 'Serial Number';
            }else{
                $sn = '-';
            }

            $data = array(
                "ItemCode"  => $a,
                "ItemName"  => $b,
                "Department" => $f,
                "Category" => 'INVENTORY',
                "SerialNumberStatus" => array(array(
                    "SerialNumberType"  => $sn,
                    "SerialNumber"  => $d,
                )),
                "ItemDetail" => array(array(
                    "MasterItem" =>$g,
                    "SubMasterItem" => $h. '|' .$i,
                    "BrandName" => $j,
                    "Color" => $k,
                    "YearOfPurchase" => $m
                )),
                "Status" => array(
                    "IsError" => "false",
                    "ResponseCode" => "00",
                    "ErrorDesc" => "Success"
                ),
            );

            array_push($dataReturn, $data);
        }
        $this->response($dataReturn, 200);
    }

    // function index_post() {
    //     $data = array(
    //                 // 'id'           => $this->post('id'),
    //                 'nim_mhs'   => $this->post('nim_mhs'),
    //                 'nama_mhs'  => $this->post('nama_mhs'),
    //                 'alamat'    => $this->post('alamat'),
    //                 'telp_mhs'  => $this->post('telp_mhs')
    //                 );
    //     $insert = $this->db->insert('tbl_mhs', $data);
    //     if ($insert) {
    //         $this->response(array(
    //             'status' => 'success',
    //             'message' => 'Data MahasiswaBerhasil Di tambahkan'
    //         ), 201);
    //     } else {
    //         $this->response(array(
    //             'status' => 'fail', 502));
    //     }
    // }

    // function index_put() {
    //     $nim = $this->put('id_mhs');
    //     $data = array(
    //         'id_mhs'    => $this->put('id_mhs'),
    //         'nim_mhs'   => $this->put('nim_mhs'),
    //         'nama_mhs'  => $this->put('nama_mhs'),
    //         'alamat'    => $this->put('alamat'),
    //         'telp_mhs'  => $this->put('telp_mhs')
    //     );
    //     $this->db->where('id_mhs', $nim);
    //     $update = $this->db->update('tbl_mhs', $data);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // function index_delete() {
    //     $id = $this->delete('id_mhs');
    //     $this->db->where('id_mhs', $id);
    //     $delete = $this->db->delete('tbl_mhs');
    //     if ($delete) {
    //         $this->response(array('status' => 'success'), 201);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

}
?>