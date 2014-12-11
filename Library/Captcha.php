<?php

/*
 * captcha
 * Description library 生成图像验证码
 * http://www.520.net
 * Copyright (c) 2012 
 *
 * Author houwei 
 * Creation Time  2012/10/10
 * Last Update 2014/12/4
 * Revision: 
 */
class Captcha
{
	
	private $code = null;
	
	

	public function __construct($length=5)
	{
	
		$this->code = $this->rand_string($length);
	}

	/*
		输出图片
	*/
	public function output($length=5,$width=90,$height=30)
	{

		
		$type = 'png';

		/*
		    A very primitive captcha implementation
		*/
		
		/* Create Imagick object */
		$Imagick = new Imagick();
		
		/* Create the ImagickPixel object (used to set the background color on image) */
		$bg = new ImagickPixel();
		
		/* Set the pixel color to white */
		$bg->setColor( 'white' );
		
		/* Create a drawing object and set the font size */
		$ImagickDraw = new ImagickDraw();
		
		/* Set font and font size. You can also specify /path/to/font.ttf */
		//$ImagickDraw->setFont(  );
		$ImagickDraw->setFontSize( 22 );
		
		$ImagickDraw->setfillcolor("#fe6464");
		/* Create new empty image */
		$Imagick->newImage( $width, $height, $bg );
		
		/* Write the text on the image */
		$Imagick->annotateImage( $ImagickDraw, 10, 22, 0, $this->code );
		
		
		/* Add some swirl */
		$Imagick->swirlImage( 20 );
		
		
		/* Create a few random lines */
		
		for ($i = 0;$i < $length;++$i)
		{
			$ImagickDraw->line( mt_rand( 0, 70 ), mt_rand( 0, 30 ), mt_rand( 0, 70 ), mt_rand( 0, 30 ) );
		}

		/* Draw the ImagickDraw object contents to the image. */
		$Imagick->drawImage( $ImagickDraw );
		
		
		
		/* Give the image a format */
		$Imagick->setImageFormat( $type );
		
		/* Send headers and output the image */
		header( "Content-Type: image/{$Imagick->getImageFormat()}" );
		echo $Imagick->getImageBlob( );

	}


	/*
		获取验证码
	*/
	public function getCode()
	{
		return $this->code;
	}
	
	

    /**
     * 产生随机字串，字母和数字混合
     *
     * @param string $len		长度
     * @param string $type		字串类型 (0 字母 1 数字 其它 混合)
     * @param string $addChars	额外字符
     * @return string
     */
    private function rand_string($len=4,$type='5',$addChars='') { 
        $str ='';
        switch($type) {
            case 0:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars; 
                break;
            case 1:
                $chars= str_repeat('0123456789',3); 
                break;
            case 2:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars; 
                break;
            case 3:
                $chars='abcdefghijklmnopqrstuvwxyz'.$addChars; 
                break;
            default :
                // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars; 
                break;
        }
        if($len>10 ) {//位数过长重复字符串一定次数
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5); 
        }
    	if($type!=4) {
    		$chars   =   str_shuffle($chars);
    		$str     =   substr($chars,0,$len);
    	}else{
    		// 中文随机字
    		for($i=0;$i<$len;$i++){   
    		  $str.= substr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);   
    		} 
    	}
        return $str;
    }
 
}