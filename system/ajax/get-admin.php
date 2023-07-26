<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    error_reporting(0);
    session_start();
    include "system/function.php";
    if (isset($_SESSION['email']))
    {
        $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json") , true);
    }
    if ($user['role'] == "admin")
    {
        $file = glob("base/data/main/share/*.json");
    }
    else
    {
        $file = null;
    }
    usort($file, function ($a, $b)
    {
        return filemtime($b) - filemtime($a);
    });
    if (isset($_POST['page']))
    {
        $page = $_POST['page'];
    }
    else
    {
        $page = 1;
    }
    $limit = 10;
    $offset = ($page - 1) * $limit;
    $total_items = count($file);
    $jumPage = ceil($total_items / $limit);
    $files_filter = array_slice($file, $offset, $limit);
?>
<?php if (!empty($files_filter)): ?>
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>File Name</th>
                    <th>Status</th>
                    <th>Uploader</th>
                    <th>Date</th>
                    <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
            <tbody>
<?php
        foreach ($files_filter as $files)
        {
            $content = file_get_contents($files);
            $data = json_decode($content, true);
            $shareid = $data['file']['share_id'];
            if ($data['file']['status'] == "delete")
            {
                $status = "<font color=\"red\">delete</font>";
            }
            else if ($data['file']['status'] == "broken")
            {
                $status = "publish";
            }
            else if ($data['file']['status'] == "realbroken")
            {
                $status = "<font color=\"red\">broken</font>";
            }
            else
            {
                $status = $data['file']['status'];
            }
            if (!empty($data['file']['title']))
            {
                $title = $data['file']['title'];
                $shareid = $data['file']['share_id'];
                echo "
                        <tr id=\"t$shareid\">
                        <td><a href=\"/file/$shareid\">$title</a></td>
                        <td>" . $status . "</td>
                        <td>" . $data['file']['user_id'] . "</td>
                        <td>" . $data['file']['date'] . "</td>
                        <td style=\"text-align:center;\">
                        <button id=\"$shareid\" onClick=\"delete_infobro(this.id)\" class=\"btn btn-danger btn-sm\"><i class =\"fa fa-trash\"></i></button>
                        </td>
                        </tr>
                    ";
            }
        }
?>
                </tbody>
            </table>
        </div>
        <br>
        <nav class="mb-5">
        <ul class="pagination justify-content-end">
<?php
        $jumlah_page = ceil($total_items / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
        if ($page == 1)
        {
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        else
        {
            $link_prev = ($page > 1) ? $page - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for ($i = $start_number;$i <= $end_number;$i++)
        {
            $link_active = ($page == $i) ? ' active' : '';
            echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }
        if ($page == $jumlah_page)
        {
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        }
        else
        {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        }
?>
</ul>
</nav>
<?php else: ?>
<div class="alert-warning"><i class="fa fa-exclamation-triangle"></i> No Data</div>
<?php endif; ?>
<?php endif; ?>
