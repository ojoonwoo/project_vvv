<?
class Page
{
	var $pg; //-- 현제 페이지
	var $tot_no; //--전체 게시물수
	var $page_size; //--한번에 보여줄 게시물수
	var $page_count; //--전체 페이지수
	var $page_start; //--게시물 시작위치
	var $page_uncount; //--게시물 번호
	
	var $block_size; //--한번에 보여줄 불럭수
	var $block_count; //--전체 불럭수
	var $block; //--현재 불럭수
	var $block_start; //--불럭시작수
	var $block_end; //--불럭 끝수
	
	var $block_list; //--불럭의 내용을 담을 변수
	var $script; //-- 페이지관련 자바스크립트
	
	function Page($class_pg,$class_tot_no,$class_page_size,$class_block_size){
		$this->pg = $class_pg;
		$this->tot_no = $class_tot_no;
		$this->page_size = $class_page_size;
		$this->block_size = $class_block_size;
		
		$this->page_count = ceil($this->tot_no/$this->page_size); //전체 페이지수
		$this->page_start = ($this->pg - 1) * $this->page_size; //게시물 시작위치
		$this->page_uncount = $this->tot_no - $this->page_start; //게시물 번호
		
		$this->block_count = ceil($this->page_count/$this->block_size);///////// 전체 불럭수
		$this->block = ceil($this->pg/$this->block_size); //////////////////////////// 현재 불럭수
		$this->block_start = (($this->block - 1) * $this->block_size) + 1; ///////// 불럭시작수
		$this->block_end = $this->block * $this->block_size; /////////////////////// 불럭 끝수
	}
	
	function blockList( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		$block_str = '<table border="0" cellspacing="0" cellpadding="0"><tr><td>';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<a href="javascript:' . $str . $temp . ');" title="이전 ' . $this->block_size . '">이전</a>';
		}
		else
		{
			$block_str .= '이전';
		}
		$block_str .= '</td><td>';
		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="javascript:'. $str. $arrBlock[$i] . ');" style="font-weight:bold">' . $arrBlock[$i] . '</a>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= " | ";
		}
		$block_str .= '</td><td>';
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<a href="javascript:' .$str . $temp . ')" title="다음 ' . $this->block_size . '">다음</a>';
		}
		else
		{
			$block_str .= '다음';
		}
		$block_str .= '</td></tr></table>';
		return $block_str;
	}
	
	function blockList2( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<li><a href="javascript:' . $str . $temp . ');" title="이전 ' . $this->block_size . '">&lt;</a></li>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<li><a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			else
			{
				$block_str .= '<li><a class="p_now" href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= "  ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<li><a href="javascript:' .$str . $temp . ')" title="다음 ' . $this->block_size . '">&gt;</a></li>';
		}

		return $block_str;
	}

	function blockList3( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<span class="next"><a href="javascript:' . $str . $temp . ');">◀</a>&nbsp;</span>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a>';
			}
			if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<span class="next">&nbsp;<a href="javascript:' .$str . $temp . ')">▶</a></span>';
		}

		return $block_str;
	}

	function blockList4( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";

		$block_str .= '<ul class="con_paging">';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<li><a href="javascript:' . $str . $temp . ');">&lt;</a>&nbsp;</li>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<li><a href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			else
			{
				$block_str .= '<li><a class="p_now" href="javascript:'. $str.$arrBlock[$i] . ');">' . $arrBlock[$i] . '</a></li>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<li>&nbsp;<a href="javascript:' .$str . $temp . ')">&gt;</a></li>';
		}

		$block_str .= '</ul>';
		return $block_str;
	}

	function blockList5( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";

/*
              <a href="#" class="arrow"><img src="images/arrow_left.png" alt=""/></a>
              <a href="#">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#" class="arrow"><img src="images/arrow_right.png" alt=""/></a>
*/
		$block_str .= '';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<a href="#" onclick="' . $str . $temp . ');return false;" class="arrow"><img src="images/arrow_left.png" alt=""/></a>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="#" onclick="'. $str.$arrBlock[$i] . ');return false;">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="#" class="selected" onclick="'. $str.$arrBlock[$i] . ');return false;">' . $arrBlock[$i] . '</a>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<a href="#" onclick="' .$str . $temp . ');return false;" class="arrow"><img src="images/arrow_right.png" alt=""/></a>';

			
		}

		$block_str .= '';
		return $block_str;
	}

	function blockList6( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";

/*
    <a href="#" class="arrow"><img src="images/arrow_left.png" width="24" alt=""/></a>
    <a href="#" class="cnt selected"> 1 </a>
    <a href="#" class="cnt"> 2 </a>
    <a href="#" class="cnt"> 3 </a>
    <a href="#" class="cnt"> 4 </a>
    <a href="#" class="cnt"> 5 </a>
    <a href="#" class="arrow"><img src="images/arrow_right.png" width="24" alt=""/></a>
*/
		$block_str .= '';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<a href="#" onclick="' . $str . $temp . ');return false;" class="arrow"><img src="images/arrow_left.png" width="24" alt=""/></a>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="#" class="cnt" onclick="'. $str.$arrBlock[$i] . ');return false;">' . $arrBlock[$i] . '</a>';
			}
			else
			{
				$block_str .= '<a href="#" class="cnt selected" onclick="'. $str.$arrBlock[$i] . ');return false;">' . $arrBlock[$i] . '</a>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<a href="#" onclick="' .$str . $temp . ');return false;" class="arrow"><img src="images/arrow_right.png" width="24" alt=""/></a>';

			
		}

		$block_str .= '';
		return $block_str;
	}

	function blockList7( $str = "pageRun(")
	{
		$b_start = $this->block_start;
		$block_str = "";

		$block_str .= '';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<span><a href="#"><img src="../images/arrow_left_double.png"></a></span>';
			$block_str .= '<span><a href="#" onclick="' . $str . $temp . ');return false;"><img src="../images/arrow_left_single.png"></a></span>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:void(0);" onclick="'. $str.$arrBlock[$i] . ');return false;"><span>' . $arrBlock[$i] . '</span></a>';
			}
			else
			{
				$block_str .= '<a href="javascript:void(0);" onclick="'. $str.$arrBlock[$i] . ');return false;"><span>' . $arrBlock[$i] . '</span></a>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<span><a href="#" onclick="' .$str . $temp . ');return false;"><img src="../images/arrow_right_single.png"></a></span>';
			$block_str .= '<span><a href="#"><img src="../images/arrow_right_double.png"></a></span>';

			
		}

		$block_str .= '';
		return $block_str;
	}
	function blockList8( $str = "pageRun2(")
	{
		$b_start = $this->block_start;
		$block_str = "";

		$block_str .= '';
		//-- 이전 블럭
		if($this->block != 1)
		{
			$temp = $this->block_start - 1;
			$block_str .= '<span><a href="#" onclick="' . $str . $temp . ');return false;"><img src="../images/arrow_left_single.png"></a></span>';
		}

		//--블럭 리스트
		$arrBlock = array();
		while($b_start <= $this->block_end && $b_start <= $this->page_count )
		{
			$arrBlock[] = 	$b_start++;
		}
		
		for($i = 0; $i < count($arrBlock); $i++)
		{
			if($this->pg != $arrBlock[$i])
			{
				$block_str .= '<a href="javascript:void(0);" onclick="'. $str.$arrBlock[$i] . ');return false;"><span>' . $arrBlock[$i] . '</span></a>';
			}
			else
			{
				$block_str .= '<a href="javascript:void(0);" onclick="'. $str.$arrBlock[$i] . ');return false;"><span>' . $arrBlock[$i] . '</span></a>';
			}
			//if($i < (count($arrBlock) - 1) ) $block_str .= " / ";
		}
		
		//다음 블럭
		if($this->block != $this->block_count && $this->tot_no != 0){
			$temp = $this->block_end + 1;
			$block_str .= '<span><a href="#" onclick="' .$str . $temp . ');return false;"><img src="../images/arrow_right_single.png"></a></span>';

			
		}

		$block_str .= '';
		return $block_str;
	}

}

?>