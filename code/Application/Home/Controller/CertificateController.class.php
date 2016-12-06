<?php
namespace Home\Controller;
use Think\Controller;
use \Library\Page;
class CertificateController extends Controller {
	public function index(){
		$this->display();
	}
	 public function certificatelist(){
	 	/*选取分类1数据*/
	 	$certificatepage=M("certificate")->where("cid");
	 	/*分页码*/
		// 1. 获取记录总条数
		$count =$certificatepage->count();
		// 2. 设置（获取）每一页显示的个数
		$pageSize =8;
		// 3. 创建分页类对象
		$page = new Page($count, $pageSize);
		// 4.构造查询条件
		$condition=array();
		$condition['cid'] != NULL;
		// 5. 分页查询
	      $certificatepage = $certificatepage->where($condition)->order('cid desc')
	          ->limit($page->firstRow.','.$page->listRows)
	          ->select();
	      // 6. 定义分页样式
	      $page->setConfig('prev','上一页');
	      $page->setConfig('next','下一页');
	      // 7. 输出查询结果
	      $this->assign('certificate', $certificatepage);//遍历数据数据
	      $pages=$page->show();
	      $this->assign('pages',$pages);
	      //$certificate=M("certificate")->select();
	      //$this->assign("certificate",$certificate);
	      $this->display();
	}
	public function content($cid){
		$certificate=M("certificate")->find($cid);
		$this->assign("ccontent",$certificate);
		$tcertificate=M("certificate")->limit(3)->select();//比赛推荐部分
	      $this->assign("tcertificate",$tcertificate);
		$this->display();
	}

}
