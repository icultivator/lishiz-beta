<?php
// say me who add "О╩©" into start of file?
// Becouse of this 3 symbol before <?php - php get error
// i think it Sublime Text

require dirname(__FILE__).'/simple_html_dom.php';

class MCrawler extends simple_html_dom{

	  public $html;

      public function getHtml($url){
        if(extension_loaded('curl')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36');
            $this->html = curl_exec($ch);
            curl_close($ch);
            return $this->html;
        } else {
            exit('cURL模块未载入！');
        }
      }

      //获取所有列表页面
      public function getList($rule){
          if(preg_match('/(.*)\{(\d?),(\d+)\}(.*)/',$rule,$match)){
              $prefix = $match[1];
              $min = $match[2];
              $max = $match[3];
              return array('prefix'=>$prefix,'min'=>$min,'max'=>$max,'tail'=>$match[4]);
          }else{
              return false;
          }
      }

      //从列表页面中获取详情URL
      public function getUrls($rule='a'){
          $urls = array();
          foreach($this->find($rule) as $aLink){
              $urls[] = $aLink->href;
          }
          return $urls;
      }

	  public function getTitle($rule='title'){
	  	if(is_string($rule)){
	  		$title = $this->find($rule,0);
	  		if($title){
		  		return trim($title->plaintext);
		  	}else{
		  		$this->getTitle(Yii::app()->params['titleRule']);
		  	}
	  	}elseif(is_array($rule)){
	  		foreach($rule as $value) {
		  		$title = $this->find($value,0);
		  		if($title){
			  		return trim($title->plaintext);
			  		break;
			  	}else{
			  		continue;
			  	}
		  	}
		  	return NULL;
	  	}	  	
	  }

      public function getCover($rule='img',$site_url=''){
          $img_url = $this->find($rule,0)->src;
          $img_url = $this->processImage($img_url,$site_url);
          return $img_url;
      }

	  public function getContent($siteUrl='',$rule='content'){
	  	 $content = $this->find($rule,0)->innertext;
         $this->processContent($content,$siteUrl);
         return trim($content);
	  }

      public function getTags($rule='tags',$separator){
          $tags = $this->find($rule,0)->plaintext;
          if($separator!=','){
              $tags = str_replace($separator,',',$tags);
          }
          return $tags;
      }

      public function processContent(&$content,$siteUrl){
          //获取到所有的图片链接
          preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(png|jpg))\\2/i", $content, $match);
          $imgUrls = $match[3];

          foreach ($imgUrls as $imgUrl):
              $rtn = $this->processImage($imgUrl,$siteUrl);
              if ($rtn):
                  //echo '替换成功!<br>';
                  $content = str_replace($imgUrl, $rtn, $content);
              else:
                  echo 'url为空或错误!<br>';
              endif;
          endforeach;
      }

      public function processImage($imgUrl,$siteUrl){
          $picManager = new MPicManager();
          if(!strpos($imgUrl,'http://') && !strpos($imgUrl,'https://')){
              $imgUrl = $siteUrl.$imgUrl;
          }
          $filename = md5($imgUrl.time().rand(1,10000)).'.jpg';
          $flag = $picManager->download($imgUrl,$filename);
          if($flag){
              $imgUrl = $picManager->getWebPath($filename);
              return $imgUrl;
          }else{
              return false;
          }
      }

	  public function removeElement($rule){

	  	$arrRule = explode('|', $rule);

	  	foreach ($arrRule as $rule) {
	  		foreach ($this->find($rule) as $remove) {
		  		$remove->outertext = '';
		  	}
	  	}	  	

	  	foreach($this->find('comment') as $ec)
        	$ec->outertext = '';

        foreach($this->find('script') as $es)
        	$es->outertext = '';
	  	
	  	$new = $this->save();
	  	return $new;
	  }

	  public function replacePreElement(){
	  		preg_match_all('/<pre(.*)>([\s\S]*)<\/pre>/U', $this->html,$arr);
	  		foreach($this->find('pre') as $k=>$pre){
	  			if(isset($arr)&&isset($arr[2][$k]))
	  				$pre->innertext = $arr[2][$k];
	  		}

	  }
}