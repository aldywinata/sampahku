<?php

class Message_model extends CI_Model
{
    //FIX
    public function flashSuccNoClose($msg)
    {
        $data['pesan'] = '<div class="alert time alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> ' . $msg . ' </div>';
        return $data;
    }



    public function successClose($msg)
    {
        $data['pesan'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> ' . $msg . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        return $data;
    }

    // Sweetalert2 FIX

    public function notifSweets($con, $title, $msg)
    {
        $notif = [
            'icon' => $con,
            'title' => $title,
            'message' => $msg
        ];

        $this->session->set_flashdata('notif', $notif);
    }
}
