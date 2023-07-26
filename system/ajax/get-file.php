<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    error_reporting(0);
    session_start();
    include "system/function.php";

function find($pattern, $input, $flags = 0) {
    return array_merge(
      array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags))),
      preg_grep($pattern, $input, $flags)
   );
}


?>
<?php if (isset($_SESSION['email'])): ?>
<?php
        $mirror = json_decode(file_get_contents("base/data/setting/mirror.json") , true);
        $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json") , true);

    if(isset($_POST['q']) && $_POST['q'] != null){

     $all = glob("base/data/main/user/$_SESSION[email]/*.json");
     $d = array();

     foreach($all as $v){
      $k = explode("$_SESSION[email]/", $v);
      $ct = json_decode(file_get_contents("base/data/main/share/$k[1]"),true);
      $idf = $ct['file']['share_id'];
      $tl = $ct['file']['title'];
      $d[] = "".$tl."///".$idf.".json";
     }

     $req = "~".$_POST['q']."~i";
     $file = find($req, $d);

    } else {
        $file = glob("base/data/main/user/$_SESSION[email]/*.json");
        usort($file, function ($a, $b)
        {
            return filemtime($b) - filemtime($a);
        });
    }

        if (isset($_POST['page']) && $_POST['page'] != null)
        {
            $page = $_POST['page'];
        }
        else $page = 1;

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
				<th>Link</th>
				<th>File Size</th>
				<th>Date</th>
				<?php if ($user['role'] == "admin" || $mirror['multiset'] != "private"): ?>
				<th>Multiup</th>
				<?php
            endif; ?>
                <?php if ($user['role'] == "admin" || $mirror['vidset'] != "private"): ?>
				<th>VidCloud</th>
				<?php
            endif; ?>
				<th style="text-align:center;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		    
	<?php
            foreach ($files_filter as $files)
            {

            if(isset($_POST['q']) && $_POST['q'] != null){
              $kill = explode("///", $files);
            } else {
              $kill = explode("$_SESSION[email]/", $files);         
            }
                $content = file_get_contents("base/data/main/share/$kill[1]");
                $data = json_decode($content, true);
                $shareid = $data['file']['share_id'];
                $mirrorup = $data['file']['mirror'];
                $acefile = $data['file']['ace'];
                if ($data['file']['mirror'] != null)
                {
                    $multiu = "link";
                    $linku = "window.location.href='$mirrorup'";
                    $classu = "btn btn-success btn-sm";
                }
                else
                {
                    $multiu = "create";
                    $linku = "get_multi(this.id)";
                    $classu = "btn btn-info btn-sm";
                }

                if ($data['file']['vidtrack'] != null)
                {
                    $vidu = "reupload";
                    $linkvid = "get_vid(this.id)";
                    $classv = "btn btn-success btn-sm";
                }
                else
                {
                    $vidu = "create";
                    $linkvid = "get_vid(this.id)";
                    $classv = "btn btn-info btn-sm";
                }

                if (!empty($data['file']['title']))
                {
                    $title = $data['file']['title'];
                    $shareid = $data['file']['share_id'];
                    $copy = "copy_link('https://".config('site.domain')."/file/".$shareid."')";
                    echo "
			<tr id=\"t$shareid\">
				<td><a href=\"/file/$shareid\">$title</a></td>
				<td><font color=\"grey\"><i class=\"fa fa-copy\"  onclick=\"$copy\"></i></font></td>
				<td>" . formatBytes($data['file']['size']) . "</td>

				<td>" . $data['file']['date'] . "</td>
			";

                    if ($user['role'] == "admin" || $mirror['multiset'] != "private")
                    {
                        echo "<td><button id=\"$shareid\" onClick=\"$linku\" class=\"$classu\">$multiu</button></td>";
                    }
                    if ($user['role'] == "admin" || $mirror['vidset'] != "private")
                    {
                        echo "<td><button id=\"v$shareid\" onClick=\"$linkvid\" class=\"$classv\">$vidu</button></td>";
                    }
                    echo "
				<td style=\"text-align:center;\">
					<button id=\"$shareid\" onClick=\"get_info(this.id)\" class=\"btn btn-primary btn-sm\"><i class =\"fa fa-pen\"></i></button>
					<button id=\"$shareid\" onClick=\"delete_info(this.id)\" class=\"btn btn-danger btn-sm\"><i class =\"fa fa-trash\"></i></button>
				</td>
			</tr>";

                }

            }

?>
		</tbody>
	</table>
</div>
	<br>
	<nav class="mb-5">
        <ul class="pagination justify-content-end">
        <div id="iniPage" hidden="true"><?php echo $page ?></div>
        <div id="queri" hidden="true"><?php echo $_POST['q'] ?></div>
	<?php
            $jumlah_page = ceil($total_items / $limit);
            $jumlah_number = 1; 
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

<?php
        else: ?>
    <div class="alert-warning"><i class="fa fa-exclamation-triangle"></i>  No Data</div>
<?php
        endif; ?>
<?php
    endif; ?>
<?php
endif; ?>
