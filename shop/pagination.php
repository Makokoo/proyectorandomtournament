<?php


function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination pagination-large">';
	
	// previous label

	if($page==1) {
		$out.= "<li class='disabled'><span><a>&nbsp;$prevlabel&nbsp;</a></span></li>";
	} else if($page==2) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>&nbsp;$prevlabel&nbsp;</a></span></li>";
	}else {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>&nbsp;$prevlabel&nbsp;</a></span></li>";

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>&nbsp;1&nbsp;</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li><a>...</a></li>";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li><a href='javascript:void(0);' onclick='load(1)'> &nbsp;$i&nbsp; </a></li>";
		}else {
			$out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>&nbsp;$i&nbsp;</a></li>";
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li><a>...</a></li>";
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= "<li><a href='javascript:void(0);' onclick='load($tpages)'>&nbsp;$tpages&nbsp;</a></li>";
	}

	// next

	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>&nbsp;$nextlabel&nbsp;</a></span></li>";
	}else {
		$out.= "<li class='disabled'><span><a>&nbsp;$nextlabel&nbsp;</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
?>