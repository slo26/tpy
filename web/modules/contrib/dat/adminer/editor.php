<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.6.3-dev
*/error_reporting(6135);$mc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($mc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Eg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Eg)$$X=$Eg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$i;return$i;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($v){$xd=substr($v,-1);return
str_replace($xd.$xd,$xd,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Me,$mc=false){if(get_magic_quotes_gpc()){while(list($z,$X)=each($Me)){foreach($X
as$nd=>$W){unset($Me[$z][$nd]);if(is_array($W)){$Me[$z][stripslashes($nd)]=$W;$Me[]=&$Me[$z][stripslashes($nd)];}else$Me[$z][stripslashes($nd)]=($mc?$W:stripslashes($W));}}}}function
bracket_escape($v,$Ha=false){static$qg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Ha?array_flip($qg):$qg));}function
min_version($Qg,$Id="",$j=null){global$i;if(!$j)$j=$i;$xf=$j->server_info;if($Id&&preg_match('~([\d.]+)-MariaDB~',$xf,$B)){$xf=$B[1];$Qg=$Id;}return(version_compare($xf,$Qg)>=0);}function
charset($i){return(min_version("5.5.3",0,$i)?"utf8mb4":"utf8");}function
script($Gf,$pg="\n"){return"<script".nonce().">$Gf</script>$pg";}function
script_src($Jg){return"<script src='".h($Jg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($C,$Y,$Wa,$td="",$je="",$d="",$ud=""){$J="<input type='checkbox' name='$C' value='".h($Y)."'".($Wa?" checked":"").($ud?" aria-labelledby='$ud'":"").">".($je?script("qsl('input').onclick = function () { $je };",""):"");return($td!=""||$d?"<label".($d?" class='$d'":"").">$J".h($td)."</label>":$J);}function
optionlist($D,$rf=null,$Mg=false){$J="";foreach($D
as$nd=>$W){$oe=array($nd=>$W);if(is_array($W)){$J.='<optgroup label="'.h($nd).'">';$oe=$W;}foreach($oe
as$z=>$X)$J.='<option'.($Mg||is_string($z)?' value="'.h($z).'"':'').(($Mg||is_string($z)?(string)$z:$X)===$rf?' selected':'').'>'.h($X);if(is_array($W))$J.='</optgroup>';}return$J;}function
html_select($C,$D,$Y="",$ie=true,$ud=""){if($ie)return"<select name='".h($C)."'".($ud?" aria-labelledby='$ud'":"").">".optionlist($D,$Y)."</select>".(is_string($ie)?script("qsl('select').onchange = function () { $ie };",""):"");$J="";foreach($D
as$z=>$X)$J.="<label><input type='radio' name='".h($C)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$J;}function
select_input($Da,$D,$Y="",$ie="",$De=""){$Zf=($D?"select":"input");return"<$Zf$Da".($D?"><option value=''>$De".optionlist($D,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$De'>").($ie?script("qsl('$Zf').onchange = $ie;",""):"");}function
confirm($Qd="",$sf="qsl('input')"){return
script("$sf.onclick = function () { return confirm('".($Qd?js_escape($Qd):lang(0))."'); };","");}function
print_fieldset($u,$zd,$Tg=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$zd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$u');",""),"</legend>","<div id='fieldset-$u'".($Tg?"":" class='hidden'").">\n";}function
bold($Pa,$d=""){return($Pa?" class='active $d'":($d?" class='$d'":""));}function
odd($J=' class="odd"'){static$t=0;if(!$J)$t=-1;return($t++%2?$J:'');}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
json_row($z,$X=null){static$nc=true;if($nc)echo"{";if($z!=""){echo($nc?"":",")."\n\t\"".addcslashes($z,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$nc=false;}else{echo"\n}\n";$nc=true;}}function
ini_bool($dd){$X=ini_get($dd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$J;if($J===null)$J=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$J;}function
set_password($Pg,$O,$V,$G){$_SESSION["pwds"][$Pg][$O][$V]=($_COOKIE["adminer_key"]&&is_string($G)?array(encrypt_string($G,$_COOKIE["adminer_key"])):$G);}function
get_password(){$J=get_session("pwds");if(is_array($J))$J=($_COOKIE["adminer_key"]?decrypt_string($J[0],$_COOKIE["adminer_key"]):false);return$J;}function
q($Q){global$i;return$i->quote($Q);}function
get_vals($H,$f=0){global$i;$J=array();$I=$i->query($H);if(is_object($I)){while($K=$I->fetch_row())$J[]=$K[$f];}return$J;}function
get_key_vals($H,$j=null,$Af=true){global$i;if(!is_object($j))$j=$i;$J=array();$I=$j->query($H);if(is_object($I)){while($K=$I->fetch_row()){if($Af)$J[$K[0]]=$K[1];else$J[]=$K[0];}}return$J;}function
get_rows($H,$j=null,$p="<p class='error'>"){global$i;$jb=(is_object($j)?$j:$i);$J=array();$I=$jb->query($H);if(is_object($I)){while($K=$I->fetch_assoc())$J[]=$K;}elseif(!$I&&!is_object($j)&&$p&&defined("PAGE_HEADER"))echo$p.error()."\n";return$J;}function
unique_array($K,$x){foreach($x
as$w){if(preg_match("~PRIMARY|UNIQUE~",$w["type"])){$J=array();foreach($w["columns"]as$z){if(!isset($K[$z]))continue
2;$J[$z]=$K[$z];}return$J;}}}function
escape_key($z){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$z,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($z);}function
where($Z,$r=array()){global$i,$y;$J=array();foreach((array)$Z["where"]as$z=>$X){$z=bracket_escape($z,1);$f=escape_key($z);$J[]=$f.($y=="sql"&&preg_match('~^[0-9]*\.[0-9]*$~',$X)?" LIKE ".q(addcslashes($X,"%_\\")):($y=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($r[$z],q($X))));if($y=="sql"&&preg_match('~char|text~',$r[$z]["type"])&&preg_match("~[^ -@]~",$X))$J[]="$f = ".q($X)." COLLATE ".charset($i)."_bin";}foreach((array)$Z["null"]as$z)$J[]=escape_key($z)." IS NULL";return
implode(" AND ",$J);}function
where_check($X,$r=array()){parse_str($X,$Ua);remove_slashes(array(&$Ua));return
where($Ua,$r);}function
where_link($t,$f,$Y,$le="="){return"&where%5B$t%5D%5Bcol%5D=".urlencode($f)."&where%5B$t%5D%5Bop%5D=".urlencode(($Y!==null?$le:"IS NULL"))."&where%5B$t%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($g,$r,$M=array()){$J="";foreach($g
as$z=>$X){if($M&&!in_array(idf_escape($z),$M))continue;$_a=convert_field($r[$z]);if($_a)$J.=", $_a AS ".idf_escape($z);}return$J;}function
cookie($C,$Y,$Bd=2592000){global$aa;return
header("Set-Cookie: $C=".urlencode($Y).($Bd?"; expires=".gmdate("D, d M Y H:i:s",time()+$Bd)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($sc=false){if(!ini_bool("session.use_cookies")||($sc&&@ini_set("session.use_cookies",false)!==false))session_write_close();}function&get_session($z){return$_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z,$X){$_SESSION[$z][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Pg,$O,$V,$n=null){global$Fb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Fb))."|username|".($n!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($Pg!="server"||$O!=""?urlencode($Pg)."=".urlencode($O)."&":"")."username=".urlencode($V).($n!=""?"&db=".urlencode($n):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Dd,$Qd=null){if($Qd!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Dd!==null?$Dd:$_SERVER["REQUEST_URI"]))][]=$Qd;}if($Dd!==null){if($Dd=="")$Dd=".";header("Location: $Dd");exit;}}function
query_redirect($H,$Dd,$Qd,$Xe=true,$Yb=true,$fc=false,$fg=""){global$i,$p,$b;if($Yb){$Mf=microtime(true);$fc=!$i->query($H);$fg=format_time($Mf);}$Jf="";if($H)$Jf=$b->messageQuery($H,$fg,$fc);if($fc){$p=error().$Jf.script("messagesPrint();");return
false;}if($Xe)redirect($Dd,$Qd.$Jf);return
true;}function
queries($H){global$i;static$Qe=array();static$Mf;if(!$Mf)$Mf=microtime(true);if($H===null)return
array(implode("\n",$Qe),format_time($Mf));$Qe[]=(preg_match('~;$~',$H)?"DELIMITER ;;\n$H;\nDELIMITER ":$H).";";return$i->query($H);}function
apply_queries($H,$T,$Vb='table'){foreach($T
as$R){if(!queries("$H ".$Vb($R)))return
false;}return
true;}function
queries_redirect($Dd,$Qd,$Xe){list($Qe,$fg)=queries(null);return
query_redirect($Qe,$Dd,$Qd,$Xe,false,!$Xe,$fg);}function
format_time($Mf){return
lang(1,max(0,microtime(true)-$Mf));}function
remove_from_uri($we=""){return
substr(preg_replace("~(?<=[?&])($we".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($E,$sb){return" ".($E==$sb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($z,$wb=false){$kc=$_FILES[$z];if(!$kc)return
null;foreach($kc
as$z=>$X)$kc[$z]=(array)$X;$J='';foreach($kc["error"]as$z=>$p){if($p)return$p;$C=$kc["name"][$z];$mg=$kc["tmp_name"][$z];$lb=file_get_contents($wb&&preg_match('~\.gz$~',$C)?"compress.zlib://$mg":$mg);if($wb){$Mf=substr($lb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Mf,$Ye))$lb=iconv("utf-16","utf-8",$lb);elseif($Mf=="\xEF\xBB\xBF")$lb=substr($lb,3);$J.=$lb."\n\n";}else$J.=$lb;}return$J;}function
upload_error($p){$Nd=($p==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($p?lang(2).($Nd?" ".lang(3,$Nd):""):lang(4));}function
repeat_pattern($Be,$_d){return
str_repeat("$Be{0,65535}",$_d/65535)."$Be{0,".($_d%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($Q,$_d=80,$Tf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$_d).")($)?)u",$Q,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$_d).")($)?)",$Q,$B);return
h($B[1]).$Tf.(isset($B[2])?"":"<i>...</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Me,$Uc=array()){$J=false;while(list($z,$X)=each($Me)){if(!in_array($z,$Uc)){if(is_array($X)){foreach($X
as$nd=>$W)$Me[$z."[$nd]"]=$W;}else{$J=true;echo'<input type="hidden" name="'.h($z).'" value="'.h($X).'">';}}}return$J;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($R,$gc=false){$J=table_status($R,$gc);return($J?$J:array("Name"=>$R));}function
column_foreign_keys($R){global$b;$J=array();foreach($b->foreignKeys($R)as$wc){foreach($wc["source"]as$X)$J[$X][]=$wc;}return$J;}function
enum_input($U,$Da,$q,$Y,$Qb=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$q["length"],$Kd);$J=($Qb!==null?"<label><input type='$U'$Da value='$Qb'".((is_array($Y)?in_array($Qb,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Kd[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$Wa=(is_int($Y)?$Y==$t+1:(is_array($Y)?in_array($t+1,$Y):$Y===$X));$J.=" <label><input type='$U'$Da value='".($t+1)."'".($Wa?' checked':'').'>'.h($b->editVal($X,$q)).'</label>';}return$J;}function
input($q,$Y,$Bc){global$_g,$b,$y;$C=h(bracket_escape($q["field"]));echo"<td class='function'>";if(is_array($Y)&&!$Bc){$ya=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$ya[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$ya);$Bc="json";}$df=($y=="mssql"&&$q["auto_increment"]);if($df&&!$_POST["save"])$Bc=null;$Cc=(isset($_GET["select"])||$df?array("orig"=>lang(8)):array())+$b->editFunctions($q);$Da=" name='fields[$C]'";if($q["type"]=="enum")echo
h($Cc[""])."<td>".$b->editInput($_GET["edit"],$q,$Da,$Y);else{$Jc=(in_array($Bc,$Cc)||isset($Cc[$Bc]));echo(count($Cc)>1?"<select name='function[$C]'>".optionlist($Cc,$Bc===null||$Jc?$Bc:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Cc))).'<td>';$fd=$b->editInput($_GET["edit"],$q,$Da,$Y);if($fd!="")echo$fd;elseif(preg_match('~bool~',$q["type"]))echo"<input type='hidden'$Da value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Da value='1'>";elseif($q["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$q["length"],$Kd);foreach($Kd[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$Wa=(is_int($Y)?($Y>>$t)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$t]' value='".(1<<$t)."'".($Wa?' checked':'').">".h($b->editVal($X,$q)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$q["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($cg=preg_match('~text|lob~',$q["type"]))||preg_match("~\n~",$Y)){if($cg&&$y!="sqlite")$Da.=" cols='50' rows='12'";else{$L=min(12,substr_count($Y,"\n")+1);$Da.=" cols='30' rows='$L'".($L==1?" style='height: 1.2em;'":"");}echo"<textarea$Da>".h($Y).'</textarea>';}elseif($Bc=="json"||preg_match('~^jsonb?$~',$q["type"]))echo"<textarea$Da cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Pd=(!preg_match('~int~',$q["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$q["length"],$B)?((preg_match("~binary~",$q["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$q["unsigned"]?1:0)):($_g[$q["type"]]?$_g[$q["type"]]+($q["unsigned"]?0:1):0));if($y=='sql'&&min_version(5.6)&&preg_match('~time~',$q["type"]))$Pd+=7;echo"<input".((!$Jc||$Bc==="")&&preg_match('~(?<!o)int(?!er)~',$q["type"])&&!preg_match('~\[\]~',$q["full_type"])?" type='number'":"")." value='".h($Y)."'".($Pd?" data-maxlength='$Pd'":"").(preg_match('~char|binary~',$q["type"])&&$Pd>20?" size='40'":"")."$Da>";}echo$b->editHint($_GET["edit"],$q,$Y);$nc=0;foreach($Cc
as$z=>$X){if($z===""||!$X)break;$nc++;}if($nc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $nc), oninput: function () { this.onchange(); }});");}}function
process_input($q){global$b,$o;$v=bracket_escape($q["field"]);$Bc=$_POST["function"][$v];$Y=$_POST["fields"][$v];if($q["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($q["auto_increment"]&&$Y=="")return
null;if($Bc=="orig")return($q["on_update"]=="CURRENT_TIMESTAMP"?idf_escape($q["field"]):false);if($Bc=="NULL")return"NULL";if($q["type"]=="set")return
array_sum((array)$Y);if($Bc=="json"){$Bc="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$q["type"])&&ini_bool("file_uploads")){$kc=get_file("fields-$v");if(!is_string($kc))return
false;return$o->quoteBinary($kc);}return$b->processInput($q,$Y,$Bc);}function
fields_from_edit(){global$o;$J=array();foreach((array)$_POST["field_keys"]as$z=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$z];$_POST["fields"][$X]=$_POST["field_vals"][$z];}}foreach((array)$_POST["fields"]as$z=>$X){$C=bracket_escape($z,1);$J[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($z==$o->primary),);}return$J;}function
search_tables(){global$b,$i;$_GET["where"][0]["val"]=$_POST["query"];$uf="<ul>\n";foreach(table_status('',true)as$R=>$S){$C=$b->tableName($S);if(isset($S["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$I=$i->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($R),array())),1));if(!$I||$I->fetch_row()){$Ke="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$uf<li>".($I?$Ke:"<p class='error'>$Ke: ".error())."\n";$uf="";}}}echo($uf?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($Sc,$Vd=false){global$b;$J=$b->dumpHeaders($Sc,$Vd);$te=$_POST["output"];if($te!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Sc).".$J".($te!="file"&&!preg_match('~[^0-9a-z]~',$te)?".$te":""));session_write_close();ob_flush();flush();return$J;}function
dump_csv($K){foreach($K
as$z=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$K[$z]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$K)."\r\n";}function
apply_sql_function($Bc,$f){return($Bc?($Bc=="unixepoch"?"DATETIME($f, '$Bc')":($Bc=="count distinct"?"COUNT(DISTINCT ":strtoupper("$Bc("))."$f)"):$f);}function
get_temp_dir(){$J=ini_get("upload_tmp_dir");if(!$J){if(function_exists('sys_get_temp_dir'))$J=sys_get_temp_dir();else{$s=@tempnam("","");if(!$s)return
false;$J=dirname($s);unlink($s);}}return$J;}function
file_open_lock($s){$_c=@fopen($s,"r+");if(!$_c){$_c=@fopen($s,"w");if(!$_c)return;chmod($s,0660);}flock($_c,LOCK_EX);return$_c;}function
file_write_unlock($_c,$tb){rewind($_c);fwrite($_c,$tb);ftruncate($_c,strlen($tb));flock($_c,LOCK_UN);fclose($_c);}function
password_file($ob){$s=get_temp_dir()."/adminer.key";$J=@file_get_contents($s);if($J||!$ob)return$J;$_c=@fopen($s,"w");if($_c){chmod($s,0660);$J=rand_string();fwrite($_c,$J);fclose($_c);}return$J;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$A,$q,$dg){global$b;if(is_array($X)){$J="";foreach($X
as$nd=>$W)$J.="<tr>".($X!=array_values($X)?"<th>".h($nd):"")."<td>".select_value($W,$A,$q,$dg);return"<table cellspacing='0'>$J</table>";}if(!$A)$A=$b->selectLink($X,$q);if($A===null){if(is_mail($X))$A="mailto:$X";if(is_url($X))$A=$X;}$J=$b->editVal($X,$q);if($J!==null){if(!is_utf8($J))$J="\0";elseif($dg!=""&&is_shortable($q))$J=shorten_utf8($J,max(0,+$dg));else$J=h($J);}return$b->selectVal($J,$A,$q,$X);}function
is_mail($Nb){$Aa='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Eb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Be="$Aa+(\\.$Aa+)*@($Eb?\\.)+$Eb";return
is_string($Nb)&&preg_match("(^$Be(,\\s*$Be)*\$)i",$Nb);}function
is_url($Q){$Eb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Eb?\\.)+$Eb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable($q){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$q["type"]);}function
count_rows($R,$Z,$kd,$Dc){global$y;$H=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($kd&&($y=="sql"||count($Dc)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Dc).")$H":"SELECT COUNT(*)".($kd?" FROM (SELECT 1$H GROUP BY ".implode(", ",$Dc).") x":$H));}function
slow_query($H){global$b,$og,$o;$n=$b->database();$gg=$b->queryTimeout();$Df=$o->slowQuery($H,$gg);if(!$Df&&support("kill")&&is_object($j=connect())&&($n==""||$j->select_db($n))){$sd=$j->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$sd,'&token=',$og,'\');
}, ',1000*$gg,');
</script>
';}else$j=null;ob_flush();flush();$J=@get_key_vals(($Df?$Df:$H),$j,false);if($j){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$J;}function
get_token(){$Te=rand(1,1e6);return($Te^$_SESSION["token"]).":$Te";}function
verify_token(){list($og,$Te)=explode(":",$_POST["token"]);return($Te^$_SESSION["token"])==$og;}function
lzw_decompress($Ma){$Cb=256;$Na=8;$bb=array();$ff=0;$gf=0;for($t=0;$t<strlen($Ma);$t++){$ff=($ff<<8)+ord($Ma[$t]);$gf+=8;if($gf>=$Na){$gf-=$Na;$bb[]=$ff>>$gf;$ff&=(1<<$gf)-1;$Cb++;if($Cb>>$Na)$Na++;}}$Bb=range("\0","\xFF");$J="";foreach($bb
as$t=>$ab){$Mb=$Bb[$ab];if(!isset($Mb))$Mb=$ch.$ch[0];$J.=$Mb;if($t)$Bb[]=$ch.$Mb[0];$ch=$Mb;}return$J;}function
on_help($gb,$Bf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $gb, $Bf) }, onmouseout: helpMouseout});","");}function
edit_form($a,$r,$K,$Hg){global$b,$y,$og,$p;$Xf=$b->tableName(table_status1($a,true));page_header(($Hg?lang(10):lang(11)),$p,array("select"=>array($a,$Xf)),$Xf);if($K===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$r)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0'>".script("qsl('table').onkeydown = editingKeydown;");foreach($r
as$C=>$q){echo"<tr><th>".$b->fieldName($q);$xb=$_GET["set"][bracket_escape($C)];if($xb===null){$xb=$q["default"];if($q["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$xb,$Ye))$xb=$Ye[1];}$Y=($K!==null?($K[$C]!=""&&$y=="sql"&&preg_match("~enum|set~",$q["type"])?(is_array($K[$C])?array_sum($K[$C]):+$K[$C]):$K[$C]):(!$Hg&&$q["auto_increment"]?"":(isset($_GET["select"])?false:$xb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$q);$Bc=($_POST["save"]?(string)$_POST["function"][$C]:($Hg&&$q["on_update"]=="CURRENT_TIMESTAMP"?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$q["type"])&&$Y=="CURRENT_TIMESTAMP"){$Y="";$Bc="now";}input($q,$Y,$Bc);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($r){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Hg?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Hg?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."...', this); };"):"");}}echo($Hg?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$r?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$og,'">
</form>
';}if(isset($_GET["file"])){if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7������Fé�vt2���!�r0���t~�U�'3M��W�B�'c�P�:6T\rc�A�zr_�WK�\r-�VNFS%~�c���&�\\^�r����u�ŎÞ�ً4'7k����Q��h�'g\rFB\ryT7SS�P�1=ǤcI��:�d��m>�S8L�J��t.M���	ϋ`'C����889�� �Q����2�#8А����6m����j��h�<�����9/��:�J�)ʂ�\0d>!\0Z��v�n��o(���k�7��s��>��!�R\"*nS�\0@P\"��(�#[���@g�o���zn�9k�8�n���1�I*��=�n������0�c(�;�à��!���*c��>Ύ�E7D�LJ��1����`�8(��3M��\"�39�?E�e=Ҭ�~������Ӹ7;�C����E\rd!)�a*�5ajo\0�#`�38�\0��]�e���2�	mk��e]���AZs�StZ�Z!)BR�G+�#Jv2(���c�4<�#sB�0���6YL\r�=���[�73��<�:��bx��J=	m_ ���f�l��t��I��H�3�x*���6`t6��%�U�L�eق�<�\0�AQ<P<:�#u/�:T\\>��-�xJ�͍QH\nj�L+j�z��7���`����\nk��'�N�vX>�C-T˩�����4*L�%Cj>7ߨ�ި���`���;y���q�r�3#��} :#n�\r�^�=C�Aܸ�Ǝ�s&8��K&��*0��t�S���=�[��:�\\]�E݌�/O�>^]�ø�<����gZ�V��q����� ��x\\������޺��\"J�\\î��##���D��x6��5x�������\rH�l ����b��r�7��6���j|����ۖ*�FAquvyO��WeM����D.F��:R�\$-����T!�DS`�8D�~��A`(�em�����T@O1@��X��\nLp�P�����m�yf��)	���GSEI���xC(s(a�?\$`tE�n��,�� \$a��U>,�В\$Z�kDm,G\0��\\��i��%ʹ� n��������g���b	y`��Ԇ�W� 䗗�_C��T\ni��H%�da��i�7�At�,��J�X4n����0o͹�9g\nzm�M%`�'I���О-���7:p�3p��Q�rED������b2]�PF����>e���3j\n�߰t!�?4f�tK;��\rΞи�!�o�u�?���Ph���0uIC}'~��2�v�Q���8)���7�DI�=��y&��ea�s*hɕjlA�(�\"�\\��m^i��M)��^�	|~�l��#!Y�f81RS����!���62P�C��l&���xd!�|��9�`�_OY�=��G�[E�-eL�CvT� )�@�j-5���pSg�.�G=���ZE��\$\0�цKj�U��\$���G'I�P��~�ځ� ;��hNێG%*�Rj�X[�XPf^��|��T!�*N��І�\rU��^q1V!��Uz,�I|7�7�r,���7���ľB���;�+���ߕ�A�p����^���~ؼW!3P�I8]��v�J��f�q�|,���9W�f`\0�q�Z�p}[Jdhy��N�Y|�Cy,�<s A�{e�Q���hd���Ǉ �B4;ks&�������a�������;˹}�S��J���)�=d��|���Nd��I�*8���dl�ѓ�E6~Ϩ�F����X`�M\rʞ/�%B/V�I�N&;���0�UC cT&.E+��������@�0`;���G�5��ަj'������Ɛ�Y�+��QZ-i���yv��I�5��,O|�P�]Fۏ�����\0���2�49͢���n/χ]س&��I^�=�l��qfI��= �]x1GR�&�e�7��)��'��:B�B�>a�z�-���2.����bz���#�����Uᓍ�L7-�w�t�3ɵ��e���D��\$�#���j�@�G�8� �7p���R�YC��~��:�@��EU�J��;67v]�J'���q1ϳ�El�QІi�����/��{k<��֡M�po�}��r��q�؞�c�ä�_m�w��^�u������������ln���	��_�~�G�n����{kܞ�w���\rj~�K�\0�����-����B�;����b`}�CC,���-��L��8\r,��kl�ǌ�n}-5����3u�gm��Ÿ�*�/������׏�`�`�#x�+B?#�ۏN;OR\r����\$�����k��ϙ\01\0k�\0�8��a��/t���#(&�l&���p��삅���i�M�{�zp*�-g���v��6�k�	���d�؋����A`");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO��er�x�9�*ź��n3�\rщv�C��`���2G%�Y�����1��f���Ȃl��1�\ny�*pC\r\$�n�T��3=\\�r9O\"�	��l<�\r�\\��I,�s\nA��eh+M�!�q0��f�`(�N{c��+w���Y��p٧3�3��+I��j�����k��n�q���zi#^r�����3���[��o;��(��6�#�Ґ��\":cz>ߣC2v�CX�<�P��c*5\n���/�P97�|F��c0�����!���!���!��\nZ%�ć#CH�!��r8�\$���,�Rܔ2���^0��@�2��(�88P/��݄�\\�\$La\\�;c�H��HX���\nʃt���8A<�sZ�*�;I��3��@�2<���!A8G<�j�-K�({*\r��a1���N4Tc\"\\�!=1^���M9O�:�;j��\r�X��L#H�7�#Tݪ/-���p�;�B \n�2!���t]apΎ��\0R�C�v�M�I,\r���\0Hv��?kT�4����uٱ�;&���+&���\r�X���bu4ݡi88�2B�/⃖4���N8A�A)52������2��s�8�5���p�WC@�:�t�㾴�e��h\"#8_��cp^��I]OH��:zd�3g�(���Ök��\\6����2�ږ��i��7���]\r�xO�n�p�<��p�Q�U�n��|@���#G3��8bA��6�2�67%#�\\8\r��2�c\r�ݟk��.(�	��-�J;��� ��L�� ���W��㧓ѥɤ����n��ҧ���M��9ZНs]�z����y^[��4-�U\0ta��62^��.`���.C�j�[ᄠ% Q\0`d�M8�����\$O0`4���\n\0a\rA�<�@����\r!�:�BA�9�?h>�Ǻ��~̌�6Ȉh�=�-�A7X��և\\�\r��Q<蚧q�'!XΓ2�T �!�D\r��,K�\"�%�H�qR\r�̠��C =�������<c�\n#<�5�M� �E��y�������o\"�cJKL2�&��eR��W�AΐTw�ё;�J���\\`)5��ޜB�qhT3��R	�'\r+\":�8��tV�A�+]��S72��Y�F��Z85�c,���J��/+S�nBpoW�d��\"�Q��a�ZKp�ާy\$�����4�I�@L'@�xC�df�~}Q*�ҺA��Q�\"B�*2\0�.��kF�\"\r��� �o�\\�Ԣ���VijY��M��O�\$��2�ThH����0XH�5~kL���T*:~P��2�t���B\0�Y������j�vD�s.�9�s��̤�P�*x���b�o����P�\$�W/�*��z';��\$�*����d�m�Ã�'b\r�n%��47W�-�������K���@<�g�èbB��[7�\\�|�VdR��6leQ�`(Ԣ,�d��8\r�]S:?�1�`��Y�`�A�ғ%��ZkQ�sM�*���{`�J*�w��ӊ>�վ�D���>�eӾ�\"�t+po������W\$����Q�@��3t`����-k7g��]��l��E��^dW>nv�t�lzPH��FvW�V\n�h;��B�D�س/�:J��\\�+ %�����]��ъ��wa�ݫ���=��X��N�/��w�J�_[�t)5���QR2l�-:�Y9�&l R;�u#S	� ht�k�E!l���>SH��X<,��O�YyЃ%L�]\0�	��^�dw�3�,Sc�Qt�e=�M:4���2]��P�T�s��n:��u>�/�d�� ��a�'%����qҨ&@֐���H�G�@w8p����΁�Z\n��{�[�t2���a��>	�w�J�^+u~�o��µXkզBZk˱�X=��0>�t��lŃ)Wb�ܦ��'�A�,��m�Y�,�A���e��#V��+�n1I����E�+[����[��-R�mK9��~���L�-3O���`_0s���L;�����]�6��|��h�V�T:��ޞerM��a�\$~e�9�>����Д�\r��\\���J1Ú���%�=0{�	����|ޗtڼ�=���Q�|\0?��[g@u?ɝ|��4�*��c-7�4\ri'^���n;�������(���{K�h�nf���Zϝ}l�����]\r��pJ>�,gp{�;�\0��u)��s�N�'����H��C9M5��*��`�k�㬎����AhY��*����jJ�ǅPN+^� D�*��À���D��P���LQ`O&��\0�}�\$���6�Zn>��0� �e��\n��	�trp!�hV�'Py�^�*|r%|\nr\r#���@w����T.Rv�8�j�\nmB���p�� �Y0�Ϣ�m\0�@P\r8�Y\rG��d�	�QG�P%E�/@]\r���{\0�Q����bR M\rF��|��%0SDr�����f/����\":�mo�ރ�%�@�3H�x\0�l\0���	��W����\n�8\r\0}�@�D��`#�t��.�jEoDrǢlb����t�f4�0���%�0���k�z2\r� �W@�%\r\n~1��X����D2!��O�*���{0<E��k*m�0ı���|\r\n�^i��� ��!.�r � ��������f��Ĭ��+:��ŋJ�B5\$L���P���LĂ�� Z@����`^P�L%5%jp�H�W��on��kA#&���8��<K6�/����̏������XWe+&�%���c&rj��'%�x�����nK�2�2ֶ�l��*�.�r��΢���*�\r+jp�Bg�{ ���0�%1(���Z�`Q#�Ԏ�n*h��v�B����\\F\n�W�r f\$�93�G4%d�b�:JZ!�,��_��f%2��6s*F���Һ�EQ�q~��`ts�Ҁ���(�`�\r���#�R����R�r��X��:R�)�A*3�\$l�*ν:\"Xl��tbK�-��O>R�-�d��=��\$S�\$�2��}7Sf��[�}\"@�]�[6S|SE_>�q-�@z`�;�0��ƻ��C�*��[���{D��jC\nf�s�P�6'���ȕ QE���N\\%r�o�7o�G+dW4A*��#TqE�f��%�D�Z�3��2.��Rk��z@��@�E�D�`C�V!C��ŕ\0���I�)38��M3�@�3L��ZB�1F@L�h~G�1M���6��4�Xє�}ƞf�ˢIN��34��X�Btd�8\nbtN��Qb;�ܑD��L�\0��\"\n����V��6��]U�cVf���D`�M�6�O4�4sJ��55�5�\\x	�<5[F�ߵy7m�)@SV��Ğ#�x��8 ոы��`�\\`�-�v2���p���+v���U��L�xY.����\0005(�@��ⰵ[U@#�VJuX4�u_�\"JO(Dt�_	5s�^���������5�^�^V�I��\rg&]��\r\"ZCI�6��#��\r��ܓ��]7���q�0��6}o���`u��ab(�X�D�f�M�N)�V�UUF�о��=jSWi�\"\\B1Ğ�E0� �amP��&<�O_�L���.c�1Z*��R\$�h���mv�[v>ݭ�p����(��0����cP�om\0R��p�&�w+KQ�s6�}5[s�J���2��/���O �V*)�R�.Du33�F\r�;��v4���H�	_!��2��k����+��%�:�_,�eo��F��AJ�O�\"%�\n�k5`z %|�%�Ϋg|��}l�v2n7�~\0�	�YRH��@��r��xN-Jp\0���f#��@ˀmv�x��\r���2WMO/�\nD��7�}2���VW�W��wɀ7����H�k���]�\$�Mz\\�e�.f�RZ�a�B���Qd�KZ��vt���w4�\0�Z@�	��Bc;�b��>�B�	3m�n\n�o��J3��k�(܍���\"�yG\$:\r�ņ�ݎ��G6�ɲJ��y��Q�\\Q��if�����(�m)/r�\$�J�/�H�]*���g�ZOD�Ѭ��]1�g22������f�=HT��]N�&���M\0�[8x�ȮE��8&L�Vm�v����j�ט�F��\\��	���&s�@Q� \\\"�b��	��\rBs�Iw�	�Yɜ�N �7�C/&٫`�\n\n��[k���*A���T�V*UZtz{�.��y�S���#�3�ipzW@yC\nKT��1@|�z#���_CJz(B�,V�(K�_��dO���P�@X��t�Ѕ��c;�WZzW�_٠�\0ފ�CF�xR �	�\n������P�A��&������,�pfV|@N�\"�\$�[�i����������Z�\0Zd\\\"�|�W`��]��tz�o\$�\0[����u�e���ə�bhU-��,�r �Lk8��֫�V&�al����d��2;	�'-��Jyu��a���\0����a��{s�[9V\0��F��R �VB0S;D�>L4�&�ZHO1�\0�wg��S�tK��R�z���i��+�3�w��z�X�]�(G\$����D+�tչ�(#����oc�:	��Y6�\0��&��	@�	���)��!����w���# t�x�ND�����)��C��FZ�p��a��*F�b�	��ͼ����ģ�����Si/S�!��z�UH*�4����0�K�-�/���-k`�n�Li�J�~�w�Jn��\"�`�=��V�3Oį8t�>��vo��E.��Rz`��p�P���E\\��ɧ�3L�l�ѥs]T���oV��\n��	*�\r�@7)��D�m�0W�5Ӏ��ǰ�w��b���|	��JV����\"�ur\r�&N0N�B�d��d�8�D��_ͫ�^T��H#]�d�+�v�~�U,�PR%�����x���fA��C��m����͸����c��yŜD)���uH���p�p�^u\0�����}�{ѡ�\rg�s�QM�Y�2j�\r�|0\0X��@q���I`��5F�6�N��V@ӔsE�p���#\r�P�T��DeW�ؼ񛭁��z!û�:�DMV(��~X���9�\0�@���40N�ܽ~�Q�[T���e�qSv\"�\"h�\0R-�hZ�d����F5�P��`�9�D&xs9W֗5Er@o�wkb�1��PO-O�OxlH�D6/ֿ�m�ޠ��3�7T��K�~54�	�p#�I�>YIN\\5���NӃ����M��pr&�G�xM�sq����.F���8�Cs�� h�e5������*�b�)Sڪ��̭�e�0�-X� {�5|�i�֢a��ȕ6z�޽��/Y���ێM� ƃ� �\nR*8r o� @7�8Bf�z�K�r���A\$˰	p�\0?���d�k�|45}�A����ɶ�W��J�2k Gi\0\"����d���8�\0�>m��� `8�w�7�o4�cGh��Q�(퀨�8@\$<\0p��0���L�eX+�Ja�{�B��h��8�Cy���P2��Ӯ�*�EH�2���DqS�ۘ�p�0�I���k�`��S�\n�:��B�7����{-����`����6�A�W�ܖ\r�p�W#���?���{\0������cD��[<����f�--�pԌ�*B�]�nW��^��R70\r�+N�GN�\$(\0�#+y�@�@iD(8@\r�h��H�He����zz�{1���h��W1F�Who&aɜ�d6���jw�������`h�{v`RE�\nj���`�ܷ����*���ʸ}�Y��	\rY�H�6�#\0�廆��a�� Q�HEl4�d���p��#�������o�br+_)\r`��!�|dQ�>��=Qʡ��ζ�EOB'�>�P��Ӷ� A\rnK�i�� 	�����	�%<	�o;�S�@�!	�x��:���A�+\\1d\$�jO��7�%�	�/����gu�z*�G�H�5\"8��,�]raq���/�h��#����\$ /tn��8y��-�O���H�b���<�Z�!���1��`�.(uo����|`GːS��BaM	ڂ9ƞ�D@���1�B�tD��ʡ@?o�(H��qC��8E�TcncR��6�N%�rHj��2G\0�a��q �r��z9b>(P��x��<��)�x#�8�誹t���h�2v��Wo2U���t��+=�l#���j�D�	0����&R�c�\$�*̑-Z`��\r��;�|A�p�=1�	1����ƈ�bEv(^�X�P2=\0}�W���G�<���G�����R�#P�Hܮr9	��Y��!�LB���4�NC�Z��IC���MLm��,�f@eY�x�BS(�+��<4Y�)-�\r�z?\$���\"\"�� 6�E�\r)z���@ȑ��r����*��J�윋��%\$�e�J���\0A�\$ڰ/5��B0S���x��I�Q)�<��4YS�&�{��b�+IG=>�\r�PY`Z�D�`��U����F1���4d8X(����C%�`�㜭0�I\$�7W�pǁ,��Ac���&Ԍ�p\$�:�r@�\"{\0004�B�1�\rG��\nC�1A�-P.�v%��UXI�D<)��ӭ&Y�G`��W�\n�ǐ(0}�֍�= �]��1��qcT�*�@%��v\\ ��2,�0�t�\"@�T��\rP}�/d�@��6�bK��Ĝ���-�<��{F�i3g��)���Ж�8�fd���L\$1��������:\"�`�ɭ�M�35���%1�4Me�l���&N�q#�o�Nݴ@QC���O܍F(�v'#badV������\$���LgB���NǑ�)��Y��\0���y]KPr��@��s�ZЇfVI�\0��Id�b@&�8��M�umt˦���7�q3u h\n��4�M6k�<�Ă=`�D\\C�^!��:�0�y!��������)ZX(Q!���(�~���N��D����D{");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$_c=file_open_lock(get_temp_dir()."/adminer.version");if($_c)file_write_unlock($_c,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$i,$o,$Fb,$Kb,$Sb,$p,$Cc,$Gc,$aa,$ed,$y,$ba,$wd,$he,$Ce,$Qf,$Kc,$og,$sg,$_g,$Gg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=$_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$F=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$F[]=true;call_user_func_array('session_set_cookie_params',$F);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$mc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$wd=array('en'=>'English','ar'=>'العربية','bg'=>'Български','bn'=>'বাংলা','bs'=>'Bosanski','ca'=>'Català','cs'=>'Čeština','da'=>'Dansk','de'=>'Deutsch','el'=>'Ελληνικά','es'=>'Español','et'=>'Eesti','fa'=>'فارسی','fi'=>'Suomi','fr'=>'Français','gl'=>'Galego','he'=>'עברית','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'日本語','ko'=>'한국어','lt'=>'Lietuvių','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'Português','pt-br'=>'Português (Brazil)','ro'=>'Limba Română','ru'=>'Русский','sk'=>'Slovenčina','sl'=>'Slovenski','sr'=>'Српски','ta'=>'த‌மிழ்','th'=>'ภาษาไทย','tr'=>'Türkçe','uk'=>'Українська','vi'=>'Tiếng Việt','zh'=>'简体中文','zh-tw'=>'繁體中文',);function
get_lang(){global$ba;return$ba;}function
lang($v,$de=null){if(is_string($v)){$Fe=array_search($v,get_translations("en"));if($Fe!==false)$v=$Fe;}global$ba,$sg;$rg=($sg[$v]?$sg[$v]:$v);if(is_array($rg)){$Fe=($de==1?0:($ba=='cs'||$ba=='sk'?($de&&$de<5?1:2):($ba=='fr'?(!$de?0:1):($ba=='pl'?($de%10>1&&$de%10<5&&$de/10%10!=1?1:2):($ba=='sl'?($de%100==1?0:($de%100==2?1:($de%100==3||$de%100==4?2:3))):($ba=='lt'?($de%10==1&&$de%100!=11?0:($de%10>1&&$de/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($de%10==1&&$de%100!=11?0:($de%10>1&&$de%10<5&&$de/10%10!=1?1:2)):1)))))));$rg=$rg[$Fe];}$ya=func_get_args();array_shift($ya);$yc=str_replace("%d","%s",$rg);if($yc!=$rg)$ya[0]=format_number($de);return
vsprintf($yc,$ya);}function
switch_lang(){global$ba,$wd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$wd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($wd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($wd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Kd,PREG_SET_ORDER);foreach($Kd
as$B)$qa[$B[1]]=(isset($B[3])?$B[3]:1);arsort($qa);foreach($qa
as$z=>$Pe){if(isset($wd[$z])){$ba=$z;break;}$z=preg_replace('~-.*~','',$z);if(!isset($qa[$z])&&isset($wd[$z])){$ba=$z;break;}}}$sg=$_SESSION["translations"];if($_SESSION["translations_version"]!=1942322697){$sg=array();$_SESSION["translations_version"]=1942322697;}function
get_translations($vd){switch($vd){case"en":$h="A9D�y�@s:�G�(�ff�����	��:�S���a2\"1�..L'�I��m�#�s,�K��OP#I�@%9��i4�o2ύ���,9�%�P�b2��a��r\n2�NC�(�r4��1C`(�:Eb�9A�i:�&㙔�y��F��Y��\r�\n� 8Z�S=\$A����`�=�܌���0�\n��dF�	��n:Zΰ)��Q���mw����O��mfpQ�΂��q��a�į���\\�}��5�#|@�h�3��N�}@��i���t�sN}+�\\�p�ۥ�+�̈� NbB؍�8���#��'��`P�2��+ಉ���.����H�\n�:�9�P޵\r΢�6��+`#�b�2��𰡉�<��HKH����`PH�� g&��@��c@�#����:�����1�-|��̐�[\$�P����@�1\rC,� �������E2�5�)3��d��J�����\"L�1mU7Q��P���P�\$Bh�\nb�-�5H�.�chZ2E3�Ц�k�6>;��0�6-m�91��T3��Ȩ7�Q��<�k��1�jH�3�di�ac/\$C=L-i�C0�ë:6]�,Z(E�k[�kn����q�T�t]JJP���\r���b��#2�x����2�H���֔	�]���v��k�)@�ō�Z|3,�ˆ#%п[�s�2>��F4 #0z(|������|�Z�-0��J2[���^��47%	R���,OH����LV{����9�Ax^;�rA��Ar�3����FC����|\$�H��:iR~�B�@���|t����F�����%ʍ�\"��k�b��ώ�5��2�Y�&��ΎY�޶�Xv.�*�c\nz�4��3�p:r����tK�r(	����O0@(JD��X*L�%^���n�2L�sҔS	�3ue�70V�q�z���XK���\r��޽�\r\0��i8ᐟ��M]X :�\\��	{\"�rBR�i}b�|��l�0fN��,zw�Xc#�b��eY2�Q%���,D)U�g�1�\$l���s�{�5��#8�˹u�4���a�#Ā�D��Ă�L\$��ɒ0�GE�ї�I���`ft��|���A�\$��#�*�#��JH%�:�7e�ΆBP��܍Q@0���)Wd���P�J�\\� C>�� ��[�k@�7�\\�i�@��p�Jk�\\�T*`Z\nt&�'6S��dt�\\��Je`�\$�R�fq��D��/���TJfL�L�9�SXp�TU\r����^B��6�5`2��>V�E��ٱ�>��<YV�t�P\0�t\r=* (+�\"p@HB�G��;�y�����E!��8�R�z��)�\$�b��4.���CE@gM+���h���IO	rĐԲ�e�pc�\0���";break;case"ar":$h="�C�P���l*�\r�,&\n�A���(J.��0Se\\�\r��b�@�0�,\nQ,l)���µ���A��j_1�C�M��e��S�\ng@�Og���X�DM�)��0��cA��n8�e*y#au4�� �Ir*;rS�U�dJ	}���*z�U�@��X;ai1l(n������[�y�d�u'c(��oF����e3�Nb���p2N�S��ӳ:LZ�z�P�\\b�u�.�[�Q`u	!��Jy��&2��(gT��SњM�x�5g5�K�K�¦����0ʇƢ��\nS ��r\$���j�(�v����!Jb����q��0\n��j\n������j��@�z�l<\$W��rؓ��s����U&�[�*��l�ꎠ(B&�����4_!��b�>�,?t[�	��?�:�X��3ޜ:����ñ7+S��ά�	J�*h������Ȓ,2 �B����d4�PH�� gL�)��kR<�J�\"���jڽ��Bh�F��KDKo�U����Q���Y%ȋ\r5 ��ڃ��ʲ[E:|��)�N@�O��Y�oz�6�&ű0�*]��J	S�%�\$	К&�B��\rCP^6��x�0߃�A���y\$*�C! C��3�\0�94�x�3\r�P�t.P2�PHt���J\r5&�P�7�h�7!\0�7c��1�C��:��\0�7��P�6��Z0���h�-6�C�vaJ�����@!�b���*��J�:�h]4!��[*��/�o3�3:瑨�-�<N�C�k���L�\r�[f3\r�\\9�C8@ ��`�2�Z\0�7�H������0z)�|2s\r��}k���'��l����6b|A���BW�S�S��B&bh�9�|P��c�F���4�&��t/D\r��8a�^��h\\0�8��q#8^2�߸���<�^��>	!�8�����u�,��sz�a��5�P�\rK�eNL7B�~���x\r�����cE�`n�p�fA�!�:�0��g!�҇(��Q��3=6̙�sf��3ƏM鴆\$l0�p@��\r!�65Є��k�Ye���Ld`FlԆ���9�0d4T�ªIc*\"k�70�ᣍ6����\\l*�\$:3~i�|���;Ȓ��H�B�\r�'��׈\"�Nd�>��s�+b�٧7��ә(e��#����c��i�5�J��&a\$��>#��`9��\"o��!��A���xmq��ɸ�z�\"�;��JG�3bL�� N�6M�\0�¡\"2`��U`e�SK�8��8BQ!6'	}���a9��F��d�P<uJF&:@�x��-V���\0���l��@P���A��0�\0f���ֹ���)\r�04�I�&�؛S49G��6�W�,[�_?GY�E�*�HADN���U�|@򢦐����*2\\� �4�fàr\r��1�P��7s��.MI��i̶�0�L�huz\0�4���T�����I�\$�0��6�Q=�ܶ�r:�9#k�\\Q�Vb�\n	�����C�1*DKU\n*���� C/\"Ҥ��-�\0\":��8�\"\\���oNʥ�tДμt&a2���iM��Wq�8�hQIL�F��:���H�}�J�᤻B\\�\\\na���I���UJ�%��osS�,U�uJ���&�	Dc~U��d	�A� ";break;case"bg":$h="�P�\r�E�@4�!Awh�Z(&��~\n��fa��N�`���D��4���\"�]4\r;Ae2��a�������.a���rp��@ד�|.W.X4��FP�����\$�hR�s���}@�Зp�Д�B�4�sE�΢7f�&E�,��i�X\nFC1��l7c��MEo)_G����_<�Gӭ}���,k놊qPX�}F�+9���7i��Z贚i�Q��_a���Z��*�n^���S��9���Y�V��~�]�X\\R�6���}�j�}	�l�4�v��=��3	�\0�@D|�¤���[�����^]#�s.�3d��m X���3�����\\�	��.L\\͐O�p��\r�����Bz�.+�ү������H��*��A��b^˹23r���J�B��\"��ʏ��L�����|��ɪf��Jn䵉�x��Ųd��k����8�#��%5�>ؿ-�)����AK�SY0�&�\$��1<�hF�\n��<����KBi�Y-���@E�02!�R҉�!-q/�j�>�#�H�� gd���D�	\"�V�\$ҩS��в墊GN�hQ�ܫnN+Y'&��I9)�-	[�(Z6�#H؏�ȝ��9�#y&��Ī���Bu�Y3)i\\����#.�MTW���W-%D�Ji.�5�U���!�S�F��Nf(	Bj�=���kL^g͝KM+ה-V;�%��N�`�9J�r}'Fi���K�Ch;k�=�*u����6���iR��L�\$�\$pRM�%/�����H�lN<G��\n[��z�d�sL��j�9Ml�f\r�m��ܼ�2��!�N�:�n�Ro��`��7\n�mG�E�=�)+S�m�i�r���:fD���BG&�rxd�Қ�L3fK�:��C�ܡ��:�;S��\r5p���bK��\$�*\r�5�a\0�7�A\0�9�#p�# ��C(rDa�7���  ����C0=E���Ct!�����@Od���,�M�\0�D�9Sy�M����ɹ<Mj�ޤH`���.8-ۛ2x�\\\r��D���s@��x�����?@��(n��:F�A|`��12��`�q/��=&���K'�<��#��\\[3i8͚RԊ�8� �'�		O�)\$AJ3TwHi���L������H\n}����( ��6\0�)�~a�6�UpC4e~��:�0�C�s��V����̪\r!�4	�)�a���1����a\r���3�����GM�w\$.W��5�KlZ5��w���\n (N���<4���R^a1Y5l����Cpe��ng�@�i��2�ymCߠt~!�����%(l���[;H���F�KB�B���v?D��~��+��>8z.iR��h��;TU��\r(Ȟ�4�@�C�H|H���ڣd�Tښ��jUf��TR��\"�	�M��'8��Q�>��J0�y��	��������J��)е����M\ry\r\$*��=\$f�������yI�P�畂���fj�8&�`�0��&P^)�(�󒞬�z�\$\r�Y⋛qu9��)��Yˡk&�[�\0�'��Eu��#';�ѩ��׌*p��^óT�,���\\��W[w.���eW���v�ٵ-̅�4�n��1�N�[��|gUߓ��2�=~��LL\0002Abȯ�l��dڔ@���`+/�L���\\�+�^(E:�#���\$���)��[t�pM<�4�_2D��T��<��:�(�8�Esz�!KD�B԰��2.���d���g��s-�O�9�ёMv�X���3Ώ��7rO���gk�/�dh{�{�\"�%�f!D����'���8?��Vå����iM*��L\\��͓i,��;jc>:gJ���]g��e�=:�f���Ghج7����D��wZ4��Θ�#�h����m�j)�������Y�y����,Cv���W{*�ʎ�<�}r����4��d�)v�p";break;case"bn":$h="�S)\nt]\0_� 	XD)L��@�4l5���BQp�� 9��\n��\0��,��h�SE�0�b�a%�. �H�\0��.b��2n��D�e*�D��M���,OJÐ��v����х\$:IK��g5U4�L�	Nd!u>�&������a\\�@'Jx��S���4�P�D�����z�.S��E<�OS���kb�O�af�hb�\0�B���r��)����Q��W��E�{K��PP~�9\\��l*�_W	��7��ɼ� 4N�Q�� 8�'cI��g2��O9��d0�<�CA��:#ܺ�%3��5�!n�nJ�mk����,q���@ᭋ�(n+L�9�x���k�I��2�L\0I��#Vܦ�#`�������B��4��:�� �,X���2����,(_)��7*��n�\r�%3l��M�|� \r���m��K�Kp�LK���C	��S.�IL�Fs�W9�S�����T�Jz�D��dz�6��[��\$�K�����l�C�T�ODu;t���t�I�T҈J��}F� �C\rY���N��5,�SC�lB���0��Td�X�sP�*5�O5��!B���TA�yJ���r���~�6��ݵ]!y�(��<V�����8��\\�C��<�PH� i��-g(��|��MΚ�u-��b�H�ºE�\$v�Mԝ�Ey�cdG�+r�\"�A�@y��C���ܷJ}�F5�=_{�d�Aސ�L_�n)@�F\"�4:� 5�c�1�٭��Z�\\ъ5R`x*�f6�@A��4��mZ�J�m�6h��Nڟ44�@�\$Bh�\nb�:�h\\-�\\��.��M���M����,�4ǹ`�:@S��#��7��0�&�%�p����rl�XSZz��7��h�7!\0�7c��1�#��:��\0�7��`�>c��0���}z��&��P9�=�=��B�b����EA*0��̢Sx�%n��8��¸Pk�S<w��Sy�+�Ք%��LQ�\n��7���xrzA�&p@C#�\r��9>@�ޠi����x�f��� |!������|�nN��ۭv®N(�!�MFw\n��{|�-x([�Y5G�F���C���A�80�\nW�e�4�`���?\r!����s@��y�1w��B���(n���C�p� s�\$6��d�t��8��)Pz�>�����C�膏:��0�b�6Yk�:9�TZ�Y���}�\\\\K����Ct\r0�s��C��)P��f�D��=������|�o��5�\0a�\0�1��RCln��L\$�2J�r�I��c�� �\n (*�0aWZ�,����Z�\0(.M�g\"���2��8Ŕ��!�م����{Oxe_���C��(o�4�zt����o.aE�Poܮ�@XQȣj�%j����Q�����@�M���%�2M\\\nP\nl�6b��j�[��\r(�fd���*d.V�\\@��*��f��zcI'xHuPe�s�2���'lC��!�9���3�G�L�ǿf��@����*\$�P�Q��\0�¡�E�@bd[g�hL��acP�l e��U\0R�:�\\ʝF'WVR��D21J���Y�u���Y@��ޔ�\r�DC��apS\n!0jpd?�R����e-=}����{4��i�!|&�r��1!�@�8��<�O��0���):�(�\rFALq*���uΔA�>�q2����0��I��xҢkX���\"���,f' U{a�X [Ro5o)��GA\r��V��c\r`�nC��@m\r4���4�g�.�F��:�A8_`nT*`Z���Y&�\\���j\\61��)#wX&`��\\gz�NKĵ庩ܢ��A	ҥ}���������f�S�Y\n!����r:Ō�S?y���MΙڈ3%���x�f��|k6�D8�����6\"�eN�i�蕪3!��\n�0�\"��]�`L��\rZ�\n��\n����l)<��\0\0��\$aj۰�|X �k��f������-���������Z�0��Ot٧[4�7GV^���ICi�g�����E�b*\"��7�9Q��C�}R�I����ig���";break;case"bs":$h="D0�\r����e��L�S���?	E�34S6MƨA��t7��p�tp@u9���x�N0���V\"d7����dp���؈�L�A�H�a)̅.�RL��	�p7���L�X\nFC1��l7AG���n7���(U�l�����b��eēѴ�>4����)�y��FY��\n,�΢A�f �-�����e3�Nw�|��H�\r�]�ŧ��43�X�ݣw��A!�D��6e�o7�Y>9���q�\$���iM�pV�tb�q\$�٤�\n%���LI6xi6�\r(1�;��@7��\0��2ʠ@���B���D��\n�\\**h3��!�ւ>��J��J�����;.�����j�&�f)|0�B8�7���[	���*�f!\"�80��9äk����br���P���P���J3F53���7��*�;J�,\n1&#�5`ԿM�\\�2G��A j��\0�һ������5�8ȎJ˛���+j1��1�������\"��t&���P�2%�:X;JˢX=1\"������#���%u2�T)j�����t�	��A`���9�jô���T�^��\r�a�V,'k�	p�0Ղ@�	�ht)�`P�2�h�c��<���P.�����Cd|�3A\0���c0́���B��UU0�C{Z6�C�N7Z���c0�6 Cx΢�ab�9c�\r���t��pꃅ�R�	�+-;� �)�B3�Tҽ�ò����'a\0̹���\\*�#+ң@�-��p����N9��8@ ���C�c~@4��Px�����JhD'	���x�%°�\\ �U;\0!֌����i�s\"Z	�:�8�;�p(�<K'z�9�p@�:�t��|]��.c8^�x�����9��H�84�`�:q<\\�ǣD���4U8�z�s춿��T:�������5�w�#�#�\"C�n��;�fP`(rm&1����(udL��2�X�ٴ6E�4��c\0cu�8�p�K��|' 0�P���6{���#r\0P	@��B?J�P��:�P�K�v*���FiM9�W��:�hh	\n\r��;�F�Мx�;�t���p�C+='9�>Z��l!����zN�ሇ`�� @}��7�y6��yH�ya!��E���Cr6Q\\ɇ�j�xfD��<(9,f�ٚ�JjT)�('��\0�£��S>��Q�s|�p��IfqH&d�B�Y�ia�3�\0Kv#����C?!�ɛS�\"����\nL(�Ƭi�A� !*C�4�O½��M#�\"���L�(���y͡2�N}��aZ��'��� ��IK�'8˧?�6!���-�E��4mK-��E�!&�e�K9����`+r�LdZe&L�S����4�|\$�G��hB�F��g���#.N�6�6��[��&n�F*VL�x��Ϋ����_|�8���3�m�Xu<��\0��H�j~}�L�O(I�>),�Lb��H\r�'�m2N�n)�]1E�&�����E�*�[(��m\"�����w�8h��XvG�ݭ���[D�\\��-D�v��N�ъ���#g����3u���Ĵ��\n\nU�,�5K\"!";break;case"ca":$h="E9�j���e3�NC�P�\\33A�D�i��s9�LF�(��d5M�C	�@e6Ɠ���r����d�`g�I�hp��L�9��Q*�K��5L� ��S,�W-��\r��<�e4�&\"�P�b2��a��r\n1e��y��g4��&�Q:�h4�\rC�� �M���Xa����+�����\\>R��LK&��v������3��é�pt��0Y\$l�1\"P� ���d��\$�Ě`o9>U��^y�==��\n)�n�+Oo���M|���)�N�S�,�,}��t�D����\n2�\r�\$4�쒠9������I�4��\nb!��҆\n�H���\nx��c�J4��h��nx8���K�N	(���+�2��� &?��Z\"���Să�L�B �(8�<�H�4�cJhŠ�2a�o�4̍Z�0����˴�@ʡ9�(�C�p����\r�0ڶ��^t8c(��(�10؃��zR6\r�x�	㒌�&FZ�M��.̓29S��92��W �e��M� P����q]\$	���s\\��ӵc����1���OY�U�n\"��6\$�4�f϶�`2���ZV��G�L��\$Bh�\nb�2�x�6�����\"�T2ՐJ�ţd�4m*J���0��M������\$��Zt�s��ޮ'һ���<�31A2�2OĂ<��8¼��u���/��aJc�\rn�@!�b������2�D9/H��c��8̺��TN�(x�ڞM7)�hl�5���L���\0�2&�h��c�ʌ�������D��A�4�=�p��|��s\n14m2�8\r7h�.���[�Ð[6��`&ʭ�L8J�����'0�j��p�:����x����ꗅ˨��^d\n�#0H_��a�(��sw�Ai��4\r��:+�f��K7B��AH��؄�?JtT �@������H�a\\�s^JC}-��'p��Qe!����^� 1�1���B�fݢnK�M��t��e/�̘C�P	���AV�P��\r�Y�0�@\n\n�)D(P�%�|��Kq!�ٚ�Zk�@eN��:T(V�z�/jd;�\$/Cr]/qYc4�n��њu�X�-8����5'd���EP` KA��'D`TI�I\"!��D4�V�jV|F�G�@IPr=\rɺ��n�0cS\$\r�wXl\\��'�2dgD��@λL�Q\nQH:���a�\\/1��4�Q\\�=��\0�J�J�UV@0�\naYѵS\$}�\"��Q	� ��0T�)�;�ب�䌓2f����b�e��9G�-;�tRG�f�9��'q�:d��O��G#�͍\$����VaW���l��WChz/gs�����l�GH!�ɤ�թ�S.����0�	(-S\$�#Ej|�l	g �*�@�A��Z9�OzEK�gfy\n\$E[QƩʥ'ژh\n��L�&V���&L\$źz0W�a;J}7�3XlR1�����v��ab�&W)���5.1�d��iQur�jR��m����|(�@N�C�e�9P�UE�X�T�(��W�ȵ��8��Tʠ��*%��I`r0��R-�\\l�\"\n���\0�j��RH1��0�";break;case"cs":$h="O8�'c!�~\n��fa�N2�\r�C2i6�Q��h90�'Hi��b7����i��i6ȍ���A;͆Y��@v2�\r&�y�Hs�JGQ�8%9��e:L�:e2���Zt�@\nFC1��l7AP��4T�ت�;j\nb�dWeH��a1M��̬���N���e���^/J��-{�J�p�lP���D��le2b��c��u:F���\r��bʻ�P��77��LDn�[?j1F��7�����I61T7r���{�F�E3i����Ǔ^0�b�b�*,���:�GH�:ަA�7mX�5�\n����NJ�׫��02�� �1��{��?�`�5�k��<��b���6 P�֎��~�(p�4���L�)J�(�6���c(�\r�0�Զ#�4�C�\$�X�\n��4;��ގpȨ95���8K�D�'���ռ(�p5š(�C��S�������`P�7Kct2�pHRA��05@�2@���;<c*,0�\0P��2\"�=À���kʌB}89��d;.\"�@��>L�Z��5m,�@P�<��'d\$Ct=����M�66uo0���j�v�m�V|Wh�W��.i[�b�	�ht)�`P�\r�p�9`���V��[����%(���3(Tr�2��j2M�#.�5���m4#H��:�k���ͳ���\0���+�5%�p@���`�9E�d�~P�gvS����V湾X�gY�;g֞K�Dv΍a�i����Yf��\"��f��ư��Y�m��z��3H�t���֞�)�pAc�Iް3%#k7�;�����v��&���L���2�V����	���蚄ɽc�j7�\0�3���fBV�c�H����^0���a���Ջ�s�i� �8E���/Ŏֱ2�Z�眼����\$����X�d:�׸0�]�A�w����@��x�#�%D�3����yY?����^>	!�8�����yO1��B&S\n�50v��0F�12�R\n�U~iK�%e��1=HN	�q\$�U!��T��(\np�\0@0���4�h�w�暙!��58��'1�`���\rA�����O�z;H�L�2C#�����ވY���H��\0�@ \n (��j�s����V�I\rI�P��@T����E���s>�9�Dv��-��+��k#)6������9�8���8L݄�N.�L8~N���Oe�����\nK�\$�sۡ1ꐁ�r�D�Xa(R�@���K�5�У:�۸vW��K�\"��\n�<!@'�0���P}85�o�q(f�Pο�&�\rzz�4�p�p�k�5!��E>���+\n�8�Ba%\$�X6�3��\$�g���.A\0F\n�4ߓ	lP�f�q2���%�����>,�~�(zZ/�m�s~���\rf�u��'�P��B���~n	�\\[k8��FiZ�Z),0����(F��.�[Ra���f�X:�,={I��6Y�(uݬD��MN!Df���H	��z��� �f�\\��&��^�GF��y�E�P��h8%uΣ���l�|��mn�YQZ{�W*�.�As�<�]�J�W�(D�K�1�=�\\q͙�e`(-Z�\"�J�|4�0=�����D%��UaM!~D-є�ވ�i�yy< �bC��#�م��M�y�d�ݓ��x�r�O�����+l�Az��\"�P��B{t�p5�S,�]0y���5���_&pA,���`*8\n�y\$+�1BhC9��\n����H�b��0�B�o��ޢ0�";break;case"da":$h="E9�Q��k5�NC�P�\\33AAD����eA�\"���o0�#cI�\\\n&�Mpci�� :IM���Js:0�#���s�B�S�\nNF��M�,��8�P�FY8�0��cA��n8����h(�r4��&�	�I7�S	�|l�I�FS%�o7l51�r������(�6�n7���13�/�)��@a:0��\n��]���t��e�����8��g:`�	���h���B\r�g�Л����)�0�3��h\n!��~�kjv�-3�e,��k\$S�V��G���)�NS:On&^�n:#��'%�x��4{�ڦ##����8�2���\"5��\$(�Bb�����|�-n��K`�7\"czD���c���Ȣ�sB��Q`�<�-�.���\0� �HK\"���\rC��@PH� h��)�N��;,���'�p���h��	���8\"�6;�(ZȤ�P�9JB�ޟB��40�3��A�Z�>3�:�T��)�FR���	@t&��Ц)�C ^��fKWV(�B����JCc�#z0��x�3N����<<dڎ�p�7�Q��\rØ�1�o��3��x��ab`9Zc�L�kZ�\"��pꚅ�R���8�67��)�B0Z��*XZ5�tiIH���絰��V<���42I[l���2�#%څ\\C�j�)!\0О���D�A�ɓ�(x�!��m\r9:�Y�bt�48���/C#,BN���Z5��,a\n)���pA�eنd42���xﷅ�F9�8��[���8_��a�6�͂�gy��9�E��*' ϴ#:tҤM��\\>~9��:\n��\r�\n5���\"�z1K�3�>.�#c�锌�sxS�\"��Gl[V��]]��4&�\n0��\0����J��0띚;e)��ȏ��I�t˳a\0�\$\no�P�:�`���3��.I8��Ȼ�D��P���rH��9�2�\0n\r愶���_��_�#Ì�Cy!̓��J	Q,%�}:��O��*5�d�0��I�}��s�{�y*��2�#�فy�<�P�O���X����K�c#�%�\0๖1)cA@'�0�@�����*C�Ĉ��B\r��3�'��-.�	0�RrN���]%9�vNI8uP��sAK#�|���N�S\n!0��\"��\0F\n�A�����s�l��%�R�8E\r�] �Z�	���R�5n�\n�a�� �h �'Q�	�*��J�R�<���3�LИ!���V�k\\R��,)��}rs цIR�JA�t�s�P��T���P���}.3)\"��Lc�i��4��%A�a*T.`)Жd������G�Tk\0P�Ɛ�b��\n/d�F�z_�:'6��߂��8�S�4O�w��E���/���'3��\n�xJU�\niZ���\n ���|F	��WF�\n\$Cxb�LӢ%�b��0K#�\"��a�o:�_���G��\n��B)*��\$&2�";break;case"de":$h="S4����@s4��S��%��pQ �\n6L�Sp��o��'C)�@f2�\r�s)�0a����i��i6�M�dd�b�\$RCI���[0��cI�� ��S:�y7�a��t\$�t��C��f4����(�e���*,t\n%�M�b���e6[�@���r��d��Qfa�&7���n9�ԇCіg/���* )aRA`��m+G;�=DY��:�֎Q���K\n�c\n|j�']�C�������\\�<,�:�\r٨U;Iz�d���g#��7%�_,�a�a#�\\���1J*��n���.2:����8�P:������\r	f-;��L:;L(��3��63 0���b�=j^�p�\0<e �	�+8�CX#��x�.�(&B�X���|wD���0�c��)�X�3� T�,�c�.���dz:��F�i�b�!,�;��P�0�K���pHP���:�b�6+C��D��¨��r7?�z4��ގ��+H���(Z��#`+T,(���0 ��C5NIB�!-3=UX���e�1��t���\rZ9�c��X+�R�\$Bh�\nb��\r�p�5]�P�Q1m��-3Q�6Vnڴ��(�Z��>�ˍ}#���-7C�������7�c`��d�����9шX\\P\n8C}\$�4�Z *�&�/�7\"�Bx��#e��#�z�bx�.�cS\0ݎ��=�d�Q�8Ym���6&i�9�����f!�b��\n�}�����y,@�6H0�)\r��3Tx���Z�]����\0��b:-2�&b�D7\rv�&��h�# ڀ��hƐ!(@-\rh�J�D�G��x�3�U63�c �6:�Kݥs[In{���;\r\$V�j�Al�-K���j�������0�3u\n��8a�^��H\\�sk��JC8^���(�š	\0_Ԏa�C�oH�Ū��b��\"�n�A�#�2F�j3e�9�,S�� '*4��S��á�v�ȝP��-\nd����4�֡�B�8��r��HY�hT�ZN��Rh��2�0���Q��f��J��ѝEB�R8 g\r�!Rtəys�9#C� %8�)�e#�<'P�8�a<)���ƅxGAAQ/X������Sc\$��`@�Z�taż�0���M����t�\$S��\n��0�He�\$792s�T_d䛳�\"O�W���D�Y�B��ȗ���s&MA�����0a\\��@�X¸��S�VG��}��e�6S�xD���՛�� Ю3�0�T�]~2Q�yJdf�Ç�g�����@�E�N�B\r�����3�BY E�:�y`�H0k)�K6\r@'y\n!2}��M\0F\n�@г�2��y\$t��V��0�	r�EF�L�Ѥ�l=���ї��\"j^U��5=9 ��T��{�D3���S0i4�\$/����\r��%��\rɰ0�b>���F�\$`B+�	7���T��Z ���&k�'*�U	ė�%mgYʞf�}��U.Ѧg�ü��'T��� J	R�%D���1@�H\n/ǙS jH̰=g\\�XS���ցF�&9\0��͌�yXr�KI�M%(�����J����-�ؑ\"��%����4蛟�rY��8Z�:�י,��|\$��Hpx�HU�����*�9y�c���-�������x ";break;case"el":$h="�J����=�Z� �&r͜�g�Y�{=;	E�30��\ng%!��F��3�,�̙i��`��d�L��I�s��9e'�A��='���\nH|�x�V�e�H56�@TБ:�hΧ�g;B�=\\EPTD\r�d�.g2�MF2A�V2i�q+��Nd*S:�d�[h�ڲ�G%����..YJ�#!��j6�2�>h\n�QQ34d�%Y_���\\Rk�_��U�[\n��OW�x�:�X� +�\\�g��+�[J��y��\"���Eb�w1uXK;r���h���s3�D6%������`�Y�J�F((zlܦ&s�/�����2��/%�A�[�7���[��JX�	�đ�Kں��m늕!iBdABpT20�:�%�#���q\\�5)��*@I����\$Ф���6�>�r��ϼ�gfy�/.J��?�@PE��WK�rC����)��/����J�\"�\0*�b���Ҫ�;\n���0�:ط1�\"���THJD���fy%�)2��������:�I.��P�[�1to&Kһ��%o<Ӥ(e���|�޽���\$�=*�\0���J��ZŤ��oi���v�LM:���E<�����g��q:Ci5�F݊��N��2z�9�Q�,�A(�C��2�86���\n\\�\rj����^x�c	����R�p�\$��������^���J�5�M��.��H�9L��]�Q�\"��h�4�����2���U��V�z����R*��R䵇�.�6O���h�]�����l�vϠh�)I��5\$I�T�Fu�M�)(�V��^���x��������9��_<�rF�>��b\r���N�(�B�_��A|'nJ��1,Ϊ}M��\"/`�_R����p޽���Ţ�%-�*�R{p�>*�);>Z���P�,sO�KzQͪ�'c��0I6�Կ�_��xۯ�IT��+L�,u�K� �\\���zn��]�m����8o��@�Z��P�,�b\$|Q�EH\$���0��0.^ǐ�%���HP�&�q��h&JEb>�Q��Ѕ�K�,)�B܋�PT\r�7��0o@�:�0��8 !�6�p��\0c\r�+H��a�9P�A�@�2F0�\"�g��0��\n%�='���2���K�d�]�� `S�Y����C\n\" ��E\$��.E>͈��\\��sC1\n�Lk������s@��yl�\\���E ��(n���@��|q`��\$�V���rT��=���J>�r��Oq{e\$�\nǛ���N�PøVN��uf�&�T���y*l!�&�ʩ�f�Yy�����D��c��v��~(� �X8a�.)�0��a�:�@��<W���:�AMhxs4|8��tx!�9�Sfm^�&8��3��%e=[\"���T\n5�\0��&l-�������:��j�P	@�\n\\��)��lZN�y^�ܥ8��-�4�7�\0��Hvi�3�\r��O\r1<7��De/�ߕD�#��\$ĉ��\"dH=J�R�#�E�%O�D���Ya[\"�i!Okn�O��\"�4�T�z��&M\$ݗI�)Úo���K�����J�X�LD�x�֫K��Հ��CJ�V{�?����w�OZ(1��v &�d��w(��\0�¤*^��_\$8��	*��ޖ\"���d%R�2\nx�9辥|\\#���a ^'���#�h��='� ��L���k� ʖ�@L�ePD�\0�+d�������O��q�uW�@'4�+���?��\0�����р�䲭\r�]\$y}�0GV��E�e�4�Վs*X>�`쐳�Q�y��Z�� ��h�6�w�Rʞ�\$z�!�Jô^y�'rS�s�^\\�CtA��0�Ck���p(ˆ�sɚ�[�*|Ь�?'�F�c�IB�z�Aj#�`�犿���,��Pݗ�U\n����	=O;X�����l��Gb(<���vtGb���c+�9%���Z�M6�>��⤛��!\\�:.�L���\"L\$��L@��A\$��Ou�^Qq�\"�AzO�u��kہD-:�N*�x��\$��k>��Ʈ��Yգ�\0��e����m�4�n�B��hz'9\"��/<�Y�	�x	��>��]8��&�Iej�EH<�x-<��\"Ef��S��?7-�\\�Y�g�\$N	�1��<�4&q�ҷ}KJ���:�l��G�=�R\$���kZ:zzH��(��������3S��B�";break;case"es":$h="�_�NgF�@s2�Χ#x�%��pQ8� 2��y��b6D�lp�t0�����h4����QY(6�Xk��\nx�E̒)t�e�	Nd)�\n�r��b�蹖�2�\0���d3\rF�q��n4��U@Q��i3�L&ȭV�t2�����4&�̆�1��)L�(N\"-��DˌM�Q��v�U#v�Bg����S���x��#W�Ўu��@���R <�f�q�Ӹ�pr�q�߼�n�3t\"O��B�7��(������%�vI��� ���P���p�@u�}��@6/̂��.#R�)�ʊ�8�4�	��0�o�*\r(�4���C��\$�[�9�**a�Ch�ˁB0ʗ��з P��D���P�:F[���P9��Z��D�LL!���2�r ޸�΃|�8n(�)ʨ��2���+ 9�(�C���Sd܌�C����^s�bJk4�e���9���*�H�h��#�BP�S�1*r�B ��Ď+� ��P�SI(�ұ��O���`�ӄ�Y�-25[\r0�:�1��	@t&��Ц)�C ���h^-�6��.�B� �<��.�cK�\r�2ͥ�`@7��3�7+.�Vҹ�؇��R�P�Ȩ7�����q%,��c0�\r���9���0�������\$7��P9�)�5�B�)Π삼��@+Lc`��A�}��b0�^���*X3-�n'&w�C>K��\n?��@a�*\0養���5�Z\"T�<!Q��o���(iPx�\r`��JPDQ\r{��|�\nh�0�0� ���/�B��NH�1���8PA��ɤ������;����8\r,`�[;�n@�:�t��lB� �-�8^�����8�~�9��JJ��N.�c��T:Fs^�'9BF:#qZsz8��D12H�P�3�MI��\0�_�-��k* ��8�\0��%�'���*Ma�39���a�A����\r��(��:c��Ca�1�x��g��ȩ�Ug��>�^^#�@\$�1(5�h�RR!0a̎�@�T\n�~��Hi�I�#e�:� �C{�.lD;��h{Q) ���7\$H��aaa̋����c�%4<@�k��Q`��&�|(J9r���\0�����Xp�����C��6 �&Wdo�p��c�`qLd���؃#��.��'���&�@'�0�M|\$W�ya���GN=tDN	�<]�D��D��E��ǳ�aHR_R��C4g9z5�E\n��\\\0S\n!1��@�\0F\n��\\8�I�ܝ=D{��h��1%g����>�=0F�,)�Bg�o)GP�C&���a�\"�e�etJ՝#TR5!�\$�`+���%�Ч9s>.u/���JX�4�!������U\n���0��-D�8�J;����\"����C��UDt��bHT��7� �#S`�0yZ\$f�)�?�b~I�6�3\na��U8ǒ�\"�+��9JjR��c�i\\Ir	����`o���w�Qb,UB<A@���j�IA��t�S����iMu��{H�C}��2(\"~��Etq0�<��n��������WR@T%��&tXiy*j�|";break;case"et":$h="K0���a�� 5�M�C)�~\n��fa�F0�M��\ry9�&!��\n2�IIن��cf�p(�a5��3#t����ΧS��%9�����p���N�S\$�X\nFC1��l7AGH��\n7��&xT��\n*LP�|� ���j��\n)�NfS����9��f\\U}:���Rɼ� 4Nғq�Uj;F��| ��:�/�II�����R��7���a�ýa�����t��p���Aߚ�'#<�{�Л��]���a��	��P�MЏ.��t�FL����AH��7�S�ʜ�M`ʵI�����H��(L3|����Bp�6�KR��;��������!��сB�0�@P���CX@'��aH#��x���R�&@0���'\r<Z�A�|7\$�;�9\r� &\r�b*�0`P�෎���d��7�H�5����@HK7�#��<��S:��\\��b	�t2C@��%h+\0��KP(\r#H��� �C��\"��[�%Ĩh�I���Գ��r�6�#r�Qj�K\rC�t��cr<�Ab@�	�ht)�`R�6����g�\"�\\���`�d�2��X���0̍����ŲĴ��c|�J�+<�R�1�l �3�b�,�C�X�W��3�/Z^8�S�2��R�\r��0�a\0�)�B68=/]E;0� @;-#m�:�cJkݭ�ـ:�J^7'�*�3#rr�M�;A\0�k��1��rt�A\0xߍ��3���&��!C8x�!��č2�צ�8��*��C��2���lHʚ��,� #�n9.���K �v��j��D4���9�Ax^;�rI��Ar�3��B<5�v�7���	#h����p�쯺��z��CZR�%P.��[:u�A^4� }���c\n�x��#������#��9G�8�35���|�7�����_��4�R*0��\0ǫ!��ҙi��T\nyz>!���C�`:0D���x�\r4�-�p�����£2���PCi���6Lg���4F����䡁3���30��T��\re���c���o���1rxKN\n�V��9\"\"<AL1zqG�6�*Pڱ`��\0��Eɖ���2+_�j�ŖA�̕SGs����ff`�Id���\0� -�*,��w @�Ykj+�H���b��L�A��\\L\$lY/̘���i�V���F �c��\r�0ߡ0��Q	�\0�2w�0T�+Z��!O�oGў&�2jwYцf�tZ��v��PUe�je�vrT���W�N��L\\�:H��sU�jM�)]�6^pN�ؐ�䠆4�C`+\rd̎0�ACaK����B�F��6�IN�5u����fZ��.D4�\"72�)���<��tC0yF-��d�=0h,�B��'��8���Oc�i��9+���T��ii%&�!ʺ v�`eQA�'��BLN�T80��b��zN`��r����Kfm5O��(Y�i\$�C�v��iG���F�xRAAԾSbK�I	";break;case"fa":$h="�B����6P텛aT�F6��(J.��0Se�SěaQ\n��\$6�Ma+X�!(A������t�^.�2�[\"S��-�\\�J���)Cfh��!(i�2o	D6��\n�sRXĨ\0Sm`ۘ��k6�Ѷ�m��kv�ᶹ6�	�C!Z�Q�dJɊ�X��+<NCiW�Q�Mb\"����*�5o#�d�v\\��%�ZA���#��g+���>m�c���[��P�vr��s��\r�ZU��s��/��H�r���%�)�NƓq�GXU�+)6\r��*��>n�?a �&IYd���cC1�[f���U6�	P��H*|�jڮ��\$+Tɬ�ZU9KIh�*�s��i	r)MrTX�3,סɂvW<*�	41\"Ȉ0��L�?�:���o����R@�7L�x��h�����˾��&����̜q7D��G\$��B�%v�L.	^�\"�#�-@HKA>�#��\$;�@PH�� gJ��c���XƬiN��+L)Ƭ�R\n;���l	r��m��p�L��1:��ư�c�eJ:�-2���κ�[2l�_&�\r}+Tmr��|����'RCQ�qL�ۉ��<�CA`P�\$Bh�\nb�-�8�.��h���%q�p��ـP�:\r��d��J��u!YA��KK9�1�ka�-\$��\rL�gcDR�6�=Z�c�<�&�P��I�[{HrB#s�pj���y�fl�j�g\n��Y�?�-J�h��zi\$fD!�b���x�2�ڂ�T�tL���2��\\�W�ED�:�x��I.╉-�\n�@�7\rc�@3\r�@:�o`�# ����Xcx�Ќ�H@!\0�9�0z(a|2u����x�+pdWk�2�%6���������L���.,Jػ+Sa�9��{H�xg�O���8����k��=��:����x/�L��.s���H�tt.������;?�	����g�Q����J�w@�l��%���yp�T^YPiP�4ط��\$K�ʆP@C�u��;���\0b���Թ��C*�!����Cc��9�`�`o�&���h���0ŇX��nxa�6!�x���n��&U<��B5:��+�hU\$\n-i�@\$	�3'L}s�PP�K�e)Ѥ W\0oy@n�7X�蛀o�9��(g�2�·G4\\�n\r��#������FH�S�4��c.0�f3���5)�\r\n#� L��N3Ȅ��֌����o�Y\0�7�q�\$�7f�� �F��o��2�0� sn�\n7�\0@��u�s3 �]\$��z7�GYhq���0˩�d��;Y��d�ILqE�-6���:B�	B5*.z,�6Y��:�}�I܄y\$�-���N��\\>�j���lR!@�谡*n���8\naD&R�l�aD�4陪`�%�Ҡ\"u,�=Q��\$+~5\n���0�\\:zq���دH�>�s&ͩ-V����S��*	b�ŝX\$�_\$\$)���.�1e�\r�%snɜ�n��9ڞg����R���0u��9�V�`ia�1CF����q��q86B�F��k~���c2)�=tJs�3�����މ:kBL0��t�c�ž?*ԡ�����I&t��7���i�3���RR�ͪ����>����q6��7��U�m��vf��ؙ���%g����Lw�&lL� V�,��X�1\$�V����1\nME��IeM1#���^4(��3�Q�:m����9+eU��}�H5h�5��cUy7SYen݅�~05�F�\\�";break;case"fi":$h="O6N��x��a9L#�P�\\33`����d7�Ά���i��&H��\$:GNa��l4�e�p(�u:��&蔲`t:DH�b4o�A����B��b��v?K������d3\rF�q��t<�\rL5 *Xk:��+d��nd����j0�I�ZA��a\r';e�� �K�jI�Nw}�G��\r,�k2�h����@Ʃ(vå��a��p1I��݈*mM�qza��M�C^�m��v���;��c�㞄凃�����P�F����K�u��B�ծ5�3�8[&0���SYϒ٪J26����ʅc�f&�n(���ϓ���#&�-��ӁBp�P��ҽ#�~,�!'mJt�/��B8�7�C�t�	��:%�24�zu	�Ь.��)�X0�M��4�L\0�2�P��6I��<�c�\\5ʒ���.�@�:��,���h�׎è�iL��\rc˘�#�PH�� gB�2��8���Ȗ9Bc���)?-�D�\r���8��cN��h�I�b�4G�c&#MXč4�ʁ15Z���V5�e�N�\r-0�b5�eu (�];�� �`XUE�d5VU��G�p7=RА	�ht)�`P�8�(\\-�׈�.�U\n~�	C6G@R\0�)c0̘;�j��A-���%�\$�*��@��5��0��j���Âئ\r�H�74X���-�tɈ4P�<�KB4�������>�c���d��/�eg�X�3����I�dY#F�1mNU2�\n�0�3ך��Ns+��N{<p�'�&K�޲�X�����)�B0Z��QU���dp0����V�rj*�ÞW3eф	��C�Ҩ����6&�\r�8@ ��皌jc�O�A\0x����3����o���^0�ɨ�̍�7U�NF�lĮ�gI��J\0��XF0�3l��Ԥ)��p�A����Р�t���\$�P�H�8^]��xH���^>\n��В����s��7�B\$]�e4\rn\r&Ծ�C�l?�l<t�F�\nd@�a=C�)��\"��2�S\0wlA� ��rt\$\$�������ua�c�0�_\\(o��@�P�\n&@�1�e>�X�ldԽ8S~��l9A4ӵb���	�@\$���#<@��Rf��?X	%V�CL�Ka5l�2�bv�p2-�2�x��ÐtD�,!�`o�\\��f��a�`M���Tá5	eܠbx�I�A#̄6�����/.��?u��ZP �p�b9I�J3�O��X�W�=s ���V�u%؝&j���5b�n��MZK=��\0� -_S�L7\0%��5�莟6m2���<�3b��Hg'\$�0B�Q�L�\$ST�И�N`�S\n!1�R�0T\n\0鶵�8o�#�V[�d��	y1%䤨��}\n�(�*~Ӗ,Ɩ��S��CN���n8��Б� mY8,w�B]V�ş&ꌭΩw�H�6�n�Z�\nS8�6��V<\$@4�!I�V�U\n��A3Q�BrN7�%j㓺s�f���2�l��|�胓�`��%��2�M���V��3\na�A�5V��s�N�q�8l��ׄ�z�%6jI�8V���	G�u��,�@Q��M֪����lT��6.����i��p�2�Jih�B���\n*�C^lO��6*^��@���\r%�";break;case"fr":$h="�E�1i��u9�fS���i7\n��\0�%���(�m8�g3I��e��I�cI��i��D��i6L��İ�22@�sY�2:JeS�\ntL�M&Ӄ��� �Ps��Le�C��f4����(�i���Ɠ<B�\n �LgSt�g�M�CL�7�j��?�7Y3���:N��xI�Na;OB��'��,f��&Bu��L�K������^�\rf�Έ����9�g!uz�c7�����'���z\\ή�����k��n��M<����3�0����3��P�퍏�+�����c�	+�`N�%\nJ�< L���*�����⼢��@!�	�W0��<�\nT�>c\n�Bp�6�L�:\"F�C�4A,�!/�L|\nL��0��P���l�Ĝ'o���dK�\"�Px� �R����p�2�t��1��m\r��7�j��쵈b�»Sdt:�#`@ɍ���:\"� @7�h���u!I#�8�\r�H�� gP�2`ʛ!�C��%�\n_G�e�*J�6��`�H΀P�DT��º\"�Z��`\"M���57`P�4�eB��K\n���J�\r�F0��B{+2j��n�au)G\\Sʄ�*��T�WaR9�J�7/��\$Bh�\nb�5\rAx�6���É�\"�\0����`��#s'm��F�P�T�\r	s^�0�Ц�51��ɻʢ�U��8*HV;�ΈNi�����+��շ�;BI�S�÷���]��y4f�.p���Jl���B1�t;���2���\\�� iШ7�c+2!�b���*���R��3[ջ�+)p��!�t��(4�5�R7\rhH̗B 3�ɹ!�Fj�)*�x�����J�D������x�e�<��V?�f0_�d���O1��j0��7��CZ���'�T��~Q�v�Cx8a�^��h\\0��r��~��C�H������pQ\"�E��z�ɉ=\r�Y����	43)��P�l��~`/@� ��j���5(D�&�F�[�D�\n�>tN|9�H]3��k�0�g��o/�f'r}\n��!FT������CI�5rтB�I�����H\np:�\\0 P�b�c�!\rĔ�v~��>\r�Z�rN�Ttg!'ͧ=� PCxw��ɦ砜C{3-\r�\n�LV\$*<2�����Y��\$<璓&�̓��\0��)]C��4��iM9�5om|���N)q!Ţ�d*C�\n!.��&�Q�Q3O�\"`��ȉ�#�!@'�0�O�<�ɀ�c��EHd�N 6�~���Xq����`�'a=p)����� K>\r��\0NE��cP4F��GC`o~��	�H�Y[&L(���WB0T�g�� ����i.�%Jd�Bd�Ó1:����� �a����ek�4���.qSN޹�&���\n���}F�BT����*��+ޤ�ڻ�\rOz��S��L]^_d�!� �\n��� Εط>��\r�3����fV�!)�p4���0�4�oG`2���T�����C9��utҒ��u�e�)z�e�g��u#Ķ�v{*I<,f�FwE�b�RrX@*ƶ#f�ϸRY2H�֋rc�4Mf�� V��N\$0W�sZk�\n7s\n�S4PC��=a��&�s<����2���5���kU#N�:gѲ�;k}GY�X/��W�9`�F=%�@s(���H��|�F>�*�T��yJ0��Y�`�h��V(��֕�z~�p";break;case"gl":$h="E9�j��g:����P�\\33AAD�y�@�T���l2�\r&����a9\r�1��h2�aB�Q<A'6�XkY�x��̒l�c\n�NF�I��d��1\0��B�M��	���h,�@\nFC1��l7AF#��\n7��4u�&e7B\rƃ�b7�f�S%6P\n\$��ף���]E�FS���'�M\"�c�r5z;d�jQ�0�·[���(��p�% �\n#���	ˇ)�A`�Y��'7T8N6�Bi�R��hGcK��z&�Q\n�rǓ;��T�(^e�����:��3���ҲCI�Y�J�欥�r��*�4����0�m��4�oꆖ��{Z���[��\r/ ��\r�R8�\nN��B�߈N�Q�B�ʡ�B��7�#��a�����`S�� S�<�+!(��6R��2�O����c�h���D�{갤H�:<�(�C�J�S���H����PH�� gB�/+�1�誨�A����=2\"��#�@�P�2��J���*r�E�( ��{� ����8I\"(�Ա���S��\rn4x]<Nu���?�p�@�P�3�`P�\$Bh�\nb�2�x�6����q�\"�=PK��*�8u�ϲ�n�L�ځ�4��Ԫ��.0�C9NP\"%���/��V��Cz���X�M�`¡\$*���*���7���'8E��@j��^�&'����cI^9<��V*\r�^8!�b������m���\n���P�\\֪	b�6�ѽ�_�x���,*��\"��(�h*0�p���ϴ�3��>�bw�:��!�\n43c0z*�|�/�s�}	B���:��#O���>M����y�zʒ��ӻ���у'%��;�c��c@�:�t��|B���/#8^�x��\0���9��JI6��g�	�S8j��\\�>sB��o��o�ǂCC(Ŏ3�:R�MS�mi�*�Ta\0�j���|�ĥ��*�)�rI�9�0�g�!�a���M���E)�͔4ްb�^H\0� ȧBq�?&��XJ��` \n (P�IM.X��xTЁ'dx�!\"*�\\StN�Ԓ\0���\n?�|:9P؈C�;BPt�)��AB#kE���̛�C�\r���4QB��a�|��R��S�'����H���MC�9�8JCuMƕE>��Xd���S��e��P��c���ceI`���,jg�(�s%X\rT3���gJ:u�ݨ���L�l1\0Ϳ��~�y%� �I�	#Z�o(o�:�RR~PIF+��)�����&ᄜ��V�(F\n�����L]Xķ{M~\$Њ���_9,��*�hf�i(����v�ّ2i�=��\"�yV&��~İ��:�XtR����E��qK)6����6Fm�LtBJ][�Gf9���Q�\\\$!Ԑ�p�LiEX1�P��h8!�̖��\nH��1K��;��\"*\$e�BBA�\n�T�T���A%�>i�)n�Qʠ6'a\$�7䓎I�h�0��5OLl�\"���P�K�\$4���\0�_	I>(B_\"�'c��\n�ߙ�>Pk��3�\r2�0ʜ*]U5R��U�XX\"YD*�%��e^��QA�F��kX�7�\$*z��U�Ba�1���";break;case"he":$h="�J5�\rt��U@ ��a��k���(�ff�P��������<=�R��\rt�]S�F�Rd�~�k�T-t�^q ��`�z�\0�2nI&�A�-yZV\r%��S��`(`1ƃQ��p9��'����K�&cu4���Q��� ��K*�u\r��u�I�Ќ4� MH㖩|���Bjs���=5��.��-���uF�}��D 3�~G=��`1:�F�9�k�)\\���N5�������%�n����(F�S��Rsx�&!;�V�Q��A�)��`�؎�!��F�q	���\n���7���.|��ģ���pBx��+ٮ���J�,���������+��%��֝�s����\\,��.lb���3^���a��A\$��E!(��!03B��\0PH�� g(��ۚ�0zZN<�{���\nf�#n�D�?);�妨� #�ht���I ���dt�5��F���z@K��:8�&�:Dkͨ�.0t�J�ij<��@t&��Ц)�B��Q�\"�Z6��h�2A�kz�Ǯ+�9�c��n.�ȁ>�-Q����%:6��McȞ���V��:��I۶����**L �0�R:�)T2k/B��m5 hb��v\"MY��A��3�P��z H�1�`�!�t�'�l]��۵\n��XZ0��h�7���߯j!.�@4C(��JXD&KN��x���4����33I{ x�_YNBO8�}٠��W�	�K��y.N\r��8a�^��]�b���\r����v�<�h�4��vR9�J�G��G��h2��X��z�۴[N�E�	�sW�g��!�0N������4�\0�1�����H�6B8c#6�6��8�3n8��:�c�9�c0��\r�xϋ�H�4_B9�=�@1�&�Ҍ#`皠�r\r���\\�D�F\n@�\nXR�L����&.3��x@8CH��(gv��@�L\r��::'Vû�{�\r����&d@��8LԺ8'W�^�ZY�-D0L���vI� \$̚�H�Y�D�Į%\$��\\Bp�*��ɒW(���>�	�h�4�+����ÏDe!Ta<\\��\0�¤.#����n�L�kQ&I7(��c��0d��r`���1�*�Sڞ�Z& �#G�I���M�c���i�X&\nԄ`���X�QI��h\$����:\rsNba`��\$b\r'`�����)B`sIK�N����OQҋ#ĵ�sm��Lqe�u���{�1k3��Ǩ�@C�f��B��FgV�2ʴ��\$h�\"�]EjL�TMa*?7&! �=4K��:lE5��>f�=%�h����H	zuQq��MtC��^DAz.�>�1\"fj�&a�q&W�	H0\" ���{���!bVC)J%��	Ŏ�H?�IZ}���T�C(��\"�����h�D";break;case"hu":$h="B4�����e7���P�\\33\r�5	��d8NF0Q8�m�C|��e6kiL � 0��CT�\\\n Č'�LMBl4�fj�MRr2�X)\no9��D����:OF�\\�@\nFC1��l7AL5� �\n�L��Lt�n1�eJ��7)��F�)�\n!aOL5���x��L�sT��V�\r�*DAq2Q�Ǚ�d�u'c-L� 8�'cI�'���Χ!��!4Pd&�nM�J�6�A����p�<W>do6N����\n���\"a�}�c1�=]��\n*J�Un\\t�(;�1�(6?O���'�2`AJ���cJ�92�3�:)�h6�����S���x��5O��a�izTV����#h\"\"�@�##:�.�d��9f=7�P�2��Kd�0C�		Gq��r%%4P�%\n���B(��0���H�da�CRB��0\0J2 ɠ���ʉ=ϣ�>�x�7�A l���BZ�9̔B9\r�<7�Cb�\r˛��t�P���X���R%�o����(Z6�-�+#\$����8�n�6'�\"�\r���>���s%]�25�t�<Z5�jύ��yf�6�?i[���l�Cj	T�@t8��c��<��p����9;cbJ%,sL�`mh�3��J-cX>��*\r�}pф��9���c0�`�:�9���<�=r7��<\r��ꬅ�R��dH�;*���)ɀ�7���3�\0�k�(䘌3]V��#��\nC��&A�ˢ���P�5�T�B9��\0�Ю��b1���9�b4)0z)�|�\r����|��CX��!JSl5Gæbʶ�t�5��!t5k�;����;Ӗ��8\r*@ɬ��Oō��8a�^��H]^�P�S�8^�zc³��:�_�a�6�\r�8:r���)4����L&r�##�>�£o3͡\nH�5�CX@�YC�\r�(�r�U��Z5���2��I�>l�0�\0�\0w6�aԿ̧�x!��2FL�S,\r친A�4p\ri�2@�1���Cld�'r��qB\$	2C� g��*�`������x@�(��|C:��� ��GɸCj�*7��lM��6��0B\np�9J�,;�&�њ@�iFY�+�|��9W�\"V��^F-�%r���\0ND��3>`� tH,���\"M8 ������N�)�:�R���%oM��Cp�4_�\$8�b\"����\0�¡07����(-�Y�9��&��R�1H9N�i|��U���s�U��m.pn�2�&4�p@L&Q�nÀ@��W�����Ҕ����\$}���+6�Bsɴ�.�sDİ(-X:.��� �x���n�h��(�ܬ�%�J��t���E�Ji�Φ��:0W.Hc�Ry���+M�\"�33DM�4�~�̥:�tB�F��ϗ���='OY�PU8^�e&\\Ց��\n��R}����W�GH�!\$r���~��q/&%쾣S�R�h\n/\$�h��v��a�/�4�uP\n&'��%8�r�I�7ʔ�Ω.�\"Y��LY�J8wH��D�&�今D�7�2�J:����@��)AfZİs:d�#�D���\"�~�)��u���2�X�)�,�8zL�޳���A�9R*L��2)aEkS���^���y�`���\\�t���9�";break;case"id":$h="A7\"Ʉ�i7�BQp�� 9�����A8N�i��g:���@��e9�'1p(�e9�NRiD��0���I�*70#d�@%9����L�@t�A�P)l�`1ƃQ��p9��3||+6bU�t0�͒Ҝ��f)�Nf������S+Դ�o:�\r��@n7�#I��l2������:c����>㘺M��p*���4Sq�����7hA�]��l�7���c'������'�D�\$��H�4�2�\$���E��N��)��7^���t֜s:�����(�	H�J8#�;��:T�'03������C	L\">��(ގ��P�0�ˀ�� �:\r�8���r�	�X�5�Q���@��ڜ��@��ɐꅌ�4V�)��A b�����B/#���5���ۯκ���h�\n��45è�2��TF�C��:��V4�N�@5RB!9N���ůcbv���jZ�	�ht)�`P�<�Ⱥ��hZ2�dܒ�h��L;�1�x�3-#pʺ%lN%΃�d�\r�~�	�1�i��3Oa\0�7��@�)��\$h@Ao�Hڄ6�(P9�)h�7�h�@!�b������H#d��8@3E�l�@)iE˄h�aWS7=��[d�iЂ2\\u��lk*�2%\0x�����J@D�*4އ�x�W��1/V��˱ݤ0کltЦh��9��l�2��\0002���F�d�@�:����x﯅�2��h���@��/k(_��a�ճ\r���o�82�c|�K�m��Ƕ:<:%�\$n��n`4�R2o	�#6�#���,���IFj\nK��vn�hQ֝����ZJѱɊ:s�A!�/;�\"��g �0tQ�ϐ�\$\n	�u�Zt)M�⪒��]sM�8�2��0�I#�Z:&�+ �����%������b4.�ʌ�g`�O@ Le9��T��r�ED�����t�p1�4���|�hI!������ȁo搛�0�I����.�ɛ�(!�i�3E	�@Wi؍0�T)䠢��hLXj�NH5�*҄\\J=\$� ��0�Tyb\r��4�|�A����ؙ�P�J_�L(���e�q� a*<�r�N�pk��B��-��(���Q�:��B9�!��RH��AHґ!�[EG�Z�A���!�����\r����E��Ǟ=��ߜ��Ed�#G8uH۠[�T*`Z%nc������`̡7��fD�V�IhGh<��2��ˊtG2�3�nS�!AI:I�~�f;g��4�QT<�q�%!�v�Gé�\$����E�A	hL\r�[�3d\\\0U\n(g@�U��!4��)�N�Tj����'@�暀\n�I��<\0���;s�	d�P�Q�.H2��y����0";break;case"it":$h="S4�Χ#x�%���(�a9@L&�)��o����l2�\r��p�\"u9��1qp(�a��b�㙦I!6�NsY�f7��Xj�\0��B��c���H 2�NgC,�Z0��cA��n8���S|\\o���&��N�&(܂ZM7�\r1��I�b2�M��s:�\$Ɠ9�ZY7�D�	�C#\"'j	�� ���!���4Nz��S����fʠ 1�����c0���x-T�E%�� �����\n\"�&V��3��Nw���0�)���ln4�Nt�]�R�ژj	iO��4AECI�ҍ#�Cv���`N:����:���\"4�\0@�/��\nC,#��z(���T\"�H����/Р�c��2B��k���B`޵\$����ѣ�',��0�������\0�<��L�'J\n�<���xH����/�:�7#��'�K�ؗ:pP���|�:M�(Z���z�'����/�Ʒk���/Ҙ�=�(�@�ы�])I�|��R�KL��C\n4���P�\$Bh�\nb�2�x�6����[�\"�+5M�=OL�P�2H�B7��3� ��-��#�7�\0���Ìê86GnX�V��ƭt�K)���aJZ*\r�Z*b��#)�+d��x\\C4�`6&��Լ�s��.J��\r��*ܤ��R^��5�c2��&�p�#%� �W>8��C�@&@�2���D�A�\n�7yPx�!����b�2A\r�0�h�\$9&��E\"��P��*���E�j�<?��Ƀ��w��CE8a�^���]Qe�\\��z+�*j����	#h��IZ>���м���}Rc�3�2\n,�����\$���#3;��h�WO�=��ݩ�>�.���H��0��\n:���\\��A��CQ�\"iǵF�����\n�+ý3��z��������;�(	��8B�Ӆ\n0R�����	-d� �s��_i3���\$�����5E9� P��+k!�`7#r�zI��i{�G�zK�\r,(\":eKC�A��e��B�ɑ&)4���ʓ^�gi���Yc.-p�诰ƹ��m��BP�	�\"Q��(�8R\r-@93�'OIj�*��b��\n<����@�\nx\$%�â�IM�T@��@VL(6-�`���\nM&P=�����b�o�A�#D�t�y�k�E\$���I�rh��N�`�Q�q�\"\$�������fh���3+I`	)F,�,YDn	!�_�V�KB2�_�(6��@C[�8����|�K�{j�h��J�]�T*`Z\n�n7)�3�ԦZI��~�EK�s~T���eQh����qr.���BJ	Qrkӄ3�^qH�\"�����aCm\"LN|�2�6i	z/��3jS8��f��L�M�v�|��1���\$t��p\nEh�K�d_�a#�c\$��>����;oHr�O/�}���CL�4��YO�s.��1U3�^)Q4 ��";break;case"ja":$h="�W'�\nc���/�ɘ2-޼O���ᙘ@�S��N4UƂP�ԑ�\\}%QGq�B\r[^G0e<	�&��0S�8�r�&����#A�PKY}t ��Q�\$��I�+ܪ�Õ8��B0��<���h5\r��S�R�9P�:�aKI �T\n\n>��Ygn4\n�T:Shi�1zR��xL&���g`�ɼ� 4N�Q�� 8�'cI��g2��My��d0�5�CA�tt0����S�~���9�����s��=��O�\\�������F�q��E:S*Lҡ\0�U'�����(T#d	�H�E��q�E�')xZ��JA��1�� ����1@�#��9��򬣰D	s�IU�*����\$�zK��.r���S/�l� ��_')<E���a'��Js,r8H*�AU*����dB8W�*Ԗ��E�>U#�RT�8#��8DMC���_��	lr�j�Hγ�A�*�^A\n�f��øs�P^�Q�PA�gI@B���]����D��J��<� S\\��\\u�j�����ZNiv]��!4B�c0�\$Ama���J� Q�@�1�M�YV���q�C�G!t�(%	CŹvrd�9(�E�t��P�Ձ7Y�Q%~_��C48b\"s���eŒ���ʡ�xCH�4-�9�.��h��\"�>Y��\0006��H���\r�0�6=�+����iVӈ�<��R�*\r�x�0���@:�Ø�1�m��3�`@6\r�;�9����#8��`KW��`���R���s��Ub��#N�*8Y���C�E��2�0�ں- �#�T�*5#p���x婎o`�#&�7���1����2v!\0x0����J�D�����x�g�v�#�8��N�!O�\n��T���)i�r\\�-�Bh�9�]8���c�MW����4�� \\��hw�\0004@��:�;��\\]s=@��p^Ct	�;P^�C�>	!�8`���yh�Bs��y����5���\r��i��7G�����zn��y���a��\"�]�!�:�j��k���b�C�'U�3?@՚�Zk�y�6 �!�h7a��0�	�\0c��4���bA�=�4*��1�4�����A�9!!Ѕx�*\$<�ȇ��x�%1A�\$La�����!�WaQ�5��ٛSnUxpt���cZ��~l�\\7����l%�I�\\��@��K�qTO�B^��q!̓�0�Ɓ10��'�IQVIQDB�,Q1����@PI\"��Go/��s��⛦nC����9��� ��t�G��@���~f��\0�¡e��?�2�MD	7\$0@��j�iA�\0��!tI�(�r���������T\nԋN&�)C����W/ٙ�mA��P�� A�Յ0�\0f����;���5\rʼ4�Iv�h]\r��9�&���T�r��H�ad���R*h�&Š��F��\"TU��bHsc0�,���؛f,p\nl�6���k]�h�Be�-��35(ns5c\r���U�m¨T��0�'��9���L����Qs��Y�DH�~hF�NŶ�V�4&�&F��gmVЙq����,(�q��@�D��d���ș2G�`L����Àr\0V��� VZ�I�?����Q�Ā��q����M�T�	�2L�����`W�;;�Г����M��(��V.���Aݥ�w����\0�Ȓv/��";break;case"ko":$h="�E��dH�ڕL@����؊Z��h�R�?	E�30�شD���c�:��!#�t+�B�u�Ӑd��<�LJ����N\$�H��iBvr�Z��2X�\\,S�\n�%�ɖ��\n�؞VA�*zc�*��D���0��cA��n8ȡ�R`�M�i��XZ:�	J���>��]��ñN������,�	�v%�qU�Y7�D�	�� 7����i6L�S���:�����h4�N���P +�[�G�bu,�ݔ#������^�hA?�IR���(�X E=i��g̫z	��[*K��XvEJ�Ld� ��*�\n�`��J<A@p*Ā?DY8v\"�9��#@N�%yp��C�� Q�V2�� ��'d1*���A�a�L��U���<���P�I�Y�L�6F�r\r\"P��-ȧYTT������d�(v���G���SJ%�u�'YdDHe�d��E�*N��u�@@���x�&t�A��9[1/9NF&%\$\$���9`�El�-�؁A b���`˥��A�1�TT&%�J�eX���{% H\"�Bi3eMH^FE�AEq�X���%0��U�l�\$jŨu��IiO��\r�i��CA��# �\$Dú�#�Ya&�A��[��>��c�<��h�6�� ����6M�`�94�H@0�Mx�3�c�2��\"`YJ4�;��\n�{d6�#p��p�:�cx9�è�\r�x��ac|9gc�0���v�k�:��@���\$�]�d�f!�b����iX�:�<�I�iA��\n�Ie�c���`�5��0�9g���3�ɭ\r�(�c~|4���@-^B3���'4�q��^0��K*B�']6u�df��C�>]JC{�_h�9��`��c�P����4�#&��tC/H\r��8a�^��(\\0�y8�qc8^2��x���|�_�a�6�\r�����v���S��	�k!�5���\r��gT7Gd;�[H��ǈP\\)�!�:�4��h�ׇ,⃓�T!�3<�@��Ch�����\n xh7��ׇ0���\0cz�\0004��̒BI\nD��0P	A���AT'���1�.P@�!(\"��G�<XF!\r�9XH���6����ʨC�����\0�\"sI�����T�3�!l�B+�LNc\" �̤������'�R��<Hȼ kԞ����\$�/� S 7����\n	\$t<����\$4o���z�C�u7�@3 �\\��r�0���fC��,ݔ�T<�U����y�!k�m,��JdgT�����,H�;��u&�� � ��f��o�t�6r��o}| ���Q	��3G�@m�F\n�q����\$V��:hL0�k�YzR�\r#�(䫎K�K)�,|�\0Y�ZVN��U	�3G�t�#�6'�-:^Ҹ����P*R���!���\n�&a�BwB�tʏ-f����yA�x6�W�E`t?\n�P#�p����ު�\"i��:dL�ʦi�1�1J���Ŝ'H96���X�bkmoL��D��-�\$FP��l RȬ ְˀ��D�mqf�᜻mn}�Aex�#!O��W)�^	3�,���Te0�na\$Z����&R���,�\">:�\$�*D1[��\"��Y��j�^�3*e�";break;case"lt":$h="T4��FH�%���(�e8NǓY�@�W�̦á�@f�\r��Q4�k9�M�a���Ō��!�^-	Nd)!Ba����S9�lt:��F �0��cA��n8��Ui0���#I��n�P!�D�@l2����Kg\$)L�=&:\nb+�u����l�F0j���o:�\r#(��8Yƛ���/:E����@t4M���HI��'S9���P춛h��b&Nq���|�J��PV�u��o���^<k4�9`��\$�g,�#H(�,1XI�3&��7�4ٻ�,AuP��dtܺ�i�枧�z��8jJ��\n�*P:-B��94-Ի4�J\"�cZ�,(�0��~6 ��\"�(�2�:l��\\P���(�6�\"��9lZ/+��Ь�p	B����\nq@���ޚ���Ȕ�C����\nB;%�Զ4ˮ�T�=c����C\n��� @��*\0:�� ΂Os��:.�P�ρL�!hH����2����͎c��\" #J��T��*9�hh�:<r;�\"��s�90�') P��1n�.KCK�@��X��s;E�T6B�cYkz	J����Y�c\r�fҬh��4ؐ\$Bh�\nb�-�7��.��h���%uVF� ȤǏ��Sl{#	��x�3\r�8ʒ\nc(��wܹ/���7��X�<��21�l��3�b�7��p�4�@�,��j��8깅�R�!�l���x�)�B3N��*d!#rf�2�M����7���v��K�B�ZH%�Z_b���ʍ�J�����crP��y\nR�ɜ�C�`1��p�2bA\0yo\r0��I�D=�C�3��x�b�Ѯ��Mi|�3��Me`��2͘ԑ����c����(�87��eǲ\\�(4���9�Ax^;��p���Ð\\���z���ą���	#k���#�;��Ax�J�_䓲����c�oB��Y��<��N���bm'�&�2ӛ��!����@��*FT81&���v!����F�]�(eD���s�\r8hj��\0�q�a�%��Öռ~��i\r!����,���2����\$R���P	@��.�\0 韀���Jh��̆�6gK��,aЗ��.,\$A���`���fL��d��yn�X�E�J�Bk%���8��XjA!���0vq6u�]ţS�eIѯ!a��j��y.)����C����9#��,1.0ؑ3++Iy3Đ(8��m\0P	�L*Ji\0�h \naԕ���'�s_�L�1C��Vr�Ob*�1em\$1�2�K��t���P��\r\r��!?a����Yf�Q	�|�S6��0T��E;��ϼ����U16\$I\nB��q~(!FU�@Vdh���HC�:!��5��m1�%%��8�4S\r\$Z���RҴ)�xYT�Ů ��`+l41��A��v%���5�j��'��O��Y�U\n���@\\\\A5;䒢R��F��LP'M!�1\\�Э�qWr6�\0e#y��H�N!p.Dm֒T�j�\n������i�rC�<��B��|S�8�����N)�/��Ԑ�N����Z�f�ٖ)2�26`'�vkgS\"B�p\$��X�)#7yKb¤&Ԉ��S<S�v���=W��k��P�D�AB�y�q=��P�(Z�M�V�MJ�Ƽ�PŊ.qZ_[��c� Ng�%�\"<GC��";break;case"ms":$h="A7\"���t4��BQp�� 9���S	�@n0�Mb4d� 3�d&�p(�=G#�i��s4�N����n3����0r5����h	Nd))W�F��SQ��%���h5\r��Q��s7�Pca�T4� f�\$RH\n*���(1��A7[�0!��i9�`J��Xe6��鱤@k2�!�)��Bɝ/���Bk4���C%�A�4�Js.g��@��	�œ��oF�6�sB�������e9NyCJ|y�`J#h(�G�uH�>�΍ �o(ԃ�T��p(T�l��U�Ɏ�{Q*|� ���3��P�7��x䷌,8֤7Ic��50j�)&�:���\"8�9�:L�A��\"�c�7��@��%���6\"��7�.J�Gq����\n�	.zh��X�.x���2�)�ƍ`PH�� g0��P�I�\$��ld)�L�\$(�P���Ҷ��+9#��D�1\rC,�&7���9&�n:A�p@������CH�G��(�CD�P�\$Bh�\nb�-�5h�.ͣhZ2�T�>'Q�6?s�����r7��2�7�(�J�)�u2��)���n��N�7�C�Ϸce�#vrr��ab!=�v��(�;,����ڤ��k`:\$����7b�)���\rp@� t��HL,��3-x�2��Gk\n�.����&(��)��4���#%�dWU���0�A��a�9�0z)A|� .�Z�|�K�.���\$:]I��qHNT��/KjKR�Î�c� ���b�j�V|\r�\r��8a�^��\\�fn�]�z}�xܘ-!~�9��0�i�p@1ĪH�4-�3�c\0�6W�Ґ�t�a\0�Q�2�!3~�*�1�H@;�h�{��S9'�#3���C�,c0��O~4��G��=��7�����,��7����?Sv(	�k�\nPSL�2q�\r*�~U\n��:����ŢAQ\\Ƽ��:@�9;'��ۧb^���=�%\ng�cЋS)	�2�%4e��O�pInc�':���Q d��?���sv�H#`�L8 f.�.�ښ�tl�ݛJ�[(P	�L*6�b���XS��%�Pƞ�al�����fENa�R���~ă`e�dP��4J��\n!1���z{X��X#G�M�	1�\\�\"򌳉*I2\r�L�\n@�l�D�)�0rMA��)(�IƨN�\$J��%J��)t|����V�hc[o��c,�Hٜfd��9U�F&��Җd\"B�F����3�%);�!�~+c ���B5�������N�zW�)�S�`BA�>Fo�G,��j4\r�3ɓ9��#&�U1���!*�W*B��E�qkA�-�V�t��S����%7Ȋ�J)>#5�`B)/%\$h��Lj kКN���?;������MPs";break;case"nl":$h="W2�N�������)�~\n��fa�O7M�s)��j5�FS���n2�X!��o0���p(�a<M�Sl��e�2�t�I&���#y��+Nb)̅5!Q��q�;�9��`1ƃQ��p9 &pQ��i3�M�`(��ɤf˔�Y;�M`����@�߰���\n,�ঃ	�Xn7�s�����4'S���,:*R�	��5'�t)<_u�������FĜ������'5����>2��v�t+CN��6D�Ͼ��G#����{���o6v�B)�9�Øt�j´�(�+���H���ZJ�=oj9)C*d3/CI�U����<�	#\$�0��������0���4��8�&h���9/x�7���2�Bb>��\"(�4�C�(��㛬0��P�0�c@�;��(\$��x����Ԋ9�r9 �� '+èr�J��C�V���13@��Zt8bI�����\n�)��\\�+1+�#�\0�B]@\"��lf����0�9#�b5(S#�9!K�>��-Nᡣ�ę&��S\\��2��Wղj7�P�\$Bh�\nb�2�(��cU�5��p7*c�:2��k\"6�s2���`�3�����hk�\n�d�21�\rL7(%�:�cH9�è�LK���ݸ(�3�j*��%#j�:�a@��R;%��\0�)�B2|��f�������c2읣�h@7�\n��9&����MCx3�����\r�Z��8�5ɏ/c��1�P�������D��A�ȱ(n�x�!��9�Ü\0�6n\"_��������8�xڡ�0ɼ���.8���8F��c���F�-��t��L&:�.�8^����r4�A~�9��Hڗ��:n{�H-�ޔ�^ N���c���>\"~�F�,�O��\n���zY���+��(�p�H)H�3RȮ�oXn���`Е 謨K\rX\n}I!�p���+�I��r�K�H\nZD�Opb9�VH�b/jx��Di\r1�%!�J�3fh�%�%��vL�`{#g|���MI�9'd�4��x�N#A���3\"\nk)*��\$�@�f��i+�8��7�l��\r!ԣ�\0�S	�ZuG؜ �K�3�6nD�P�T���RK\nYM���5�&6~��/�-\"�uך�Q@��\"XUA`\r�p3�f�I��'���b�b/\0�)���I�\r'\\#H&Vʋ�R�63���\$TN�H񆣍\rBL�M\$qȒY��d������T���\$�1�=%���S�a�f�(@�C`+��ɠÄ�����ȅ�XH���ĝ�W��¨T��\"����T�%&T�RG��Aȕ�]7̬�D06��:*qY)(\$|��\";=��r]*\\�<p��ʜ^�/\0��Gd��)'�i,��!T��&~Og�,�QT�>�y�	����bY\nE��|.���I\0(+����\$aĘ��\nG��2+���%(iaD4W.�WQ�wP��X�����is�jGi�r9��:�r�";break;case"no":$h="E9�Q��k5�NC�P�\\33AAD����eA�\"a��t����l��\\�u6��x��A%���k����l9�!B)̅)#I̦��Zi�¨q�,�@\nFC1��l7AGCy�o9L�q��\n\$�������?6B�%#)��\n̳h�Z�r��&K�(�6�nW��mj4`�q���e>�䶁\rKM7'�*\\^�w6^MҒa��>mv�>��t��4�	����j���	�L��w;i��y�`N-1�B9{�mi���&�@��v�l����H�S\$�c/�:4;���C��80r`6� ²Zd4����a����������*���-ʠ�:�㌅-�<�!Kh�7B�<ΎP��巫dh(!L�.79�c��Bp��1hh��)\0�����CP�\"�H�xH b��n��;-��̨��E��\r�H\$2C#̹O ��h�7��P��B�қ'�\n����s���m�(-H�Jrx�M�*�2S��M=�К&�B���zb-���J����A��<7#��Z���hН�-��7���3�����P�ҡ\0�9\n�x�HRZ*9�����c0�6#�=�3�[l0��*�'��e�2��R���8�6/ː@!�b��c��J���� �X�2�,23�m�*��5+��b<�R*\r�Z�[�6 ���.9^��bB�x0�B|3���&š�^0��I�L\rnu�6'c���Xcs�3�4z���7J5JV��T4n�TH��������HЛ�t��1y����z��	����P�	#h���\"�j�l�1����8yvձ�t9HJ]S��!jt\\R#�;C\rX�;��\$���{2�i�~�Ҍu�2�I��R�U�w^5�掃Be�cn/d4���⹩����?��>/oHt���k�~�t���\nJiY���6Ƶ�?\"�%�!�_��/��:\"�po9Ź#r��3e��\"�l���\rL�����Kɉ������茊`o[N��5�RR��M'ؔ��\"V�B��*cR���>!�������8qP(̔�Ƒ�X4A��-p�i���ΆwJX�c��R�@c�;��07/B�P�[�'��N���QAhkg�3�S��/�����\\c� k2Dp�rDI�q !L(��ZI���h�*\"�\\�t*F���L��K/f,�0�v	�\nS�9O P,���c 󜏉JTI��?0�BT���e\r�M��JB\0\r��5�b#�9t[E��OR�&�?.�ӻ�2F#�U\n�,p���oa!�l���H̹7�FqP�T�(U!.Q�H����;6�Y�@S:bF0�;&��8����q�4��;�`ig��#�Dtrgɵ=2@,��AD��~F	��\r��d��Ef!�\nŸ3� ����E%�ߗ\n2`�K�-<R)u��v/���ZNL�8e";break;case"pl":$h="C=D�)��eb��)��e7�BQp�� 9���s�����\r&����yb������ob�\$Gs(�M0��g�i��n0�!�Sa�`�b!�29)�V%9���	�Y 4���I��0��cA��n8��X1�b2���i�<\n!Gj�C\r��6\"�'C��D7�8k��@r2юFF��6�Վ���Z�B��.�j4� �U��i�'\n���v7v;=��SF7&�A�<�؉����r���Z��p��k'��z\n*�κ\0Q+�5Ə&(y��\n(���X�Ƽ<�`zSq�Ε�O��猯rBA������+Hz�\n��7����8 O��3��	è��#��Ì+�|c��CJ�9Eb���B8�7���Bb��L7�Oc���\$FiH�ݍ�x��cK��+���5��\n5K�t0�2�ȉ��3:!,�1Nc��;�l��/�JZ��\\�8b\nc��5�`P�2Hz�6(oH�&0�4����R\0��<x8\r�c\$����6D�;�q*��-�Rb����\n�A6�0�攣�|�2գ\r^65�R�V]�W����c�VM����l���x�\$Bh�\nb�2�h\\-�W��.�H�H��6HO*\n��!\0�3���\np*i&�2̶�6M��܌cB92�A�C��#�B�U,B2�j�.� ����ɋ��.4�98�TY�Y#����NA�e�~\\��6�j:�Yʃ��8������Y.��zŦ��e�Fڢl'!�����)�Z b��#�\0��8۽�0�C4�6��`��!zt���؎ã�u@�a'��J�i\"	��0���#&k�0�~3����������D�A�F�9D�x�!�3�;��*۹De�K��3��)�5}��*�\rb�3�3����Cϗ��=�Aی��D4���9�Ax^;�ueՎAt��xp\r��2����N��9��dCl%�AN�7�P�@s\r��R��Pe��f旊Q%����I��(�0`ķ��#	�ԇp@@P&�P43\0�àii�	W��L�`rqA����!��1�P��k#KH�&F=��sL,�1�\0��lf`��ހ���- Qv���s���= xO�/&\$̻&�z�\\��W��%��\\�ó����\0PTK=����6n&N���^# H\r�A�?c8@Hpl���I	\rIi�A�7�����\r-ԕI8�3&*h5�\$b䙡9'd����D�C�T��\0�C�	�AQ́_(���Y����0��q.N��4�dCY5�9�P�4�ˇZ���F�/	[h.-ҷ:�xbMd�=��D��#��a�\"tm���rl�`Җ��c!��η+I�!K\rf�)���	�� ��;��R��fL=��r�0T\n~<�eD�lD=y\0��dReV���Ac�G�y&�}7:�JY�k0��4��{Z��*��S��	�!�~l34�XY�)��R�W�blJ���Ù4�M�B\r��5�ZP�})�rAN;�\$��V�U\$�1.�c�R�a|!�9�C0�0-�����_Y�XS��=��>�x��K:ܶ��n-a���%k�uj�G�s!�3��%���Dt�R<\\��~6	���.�jW��8Ӗ�RaRq�5�(�sLj\$.v*��wj�r������r�鬽�k\n'N[���(\0*��B>z�dz(G=m�Jv[�ɓ��T�c;���*����C7l�0E'UeP����V2�R�g|XA��!�%#��(k�rE\r3���Lq}\r�C`";break;case"pt":$h="T2�D��r:OF�(J.��0Q9��7�j���s9�էc)�@e7�&��2f4��SI��.&�	��6��'�I�2d��fsX�l@%9��jT�l 7E�&Z!�8���h5\r��Q��z4��F��i7M�ZԞ�	�&))��8&�̆���X\n\$��py��1~4נ\"���^��&��a�V#'��ٞ2��H���d0�vf�����β�����K\$�Sy��x��`�\\[\rOZ��x���N�-�&�����gM�[�<��7�ES�<�t���L@:��p�+�K\$a����ÁJ�d�##R��3I��0����(�e�pҤ6C�Jڹ�Z�8ȱt6���\"7.�L�Cb�.�����8����V	����[iȐ���#LV�<�CN��Ó&�+��� ��}\r��x����h��\0�<� HK8�hJ(<� Pܹ��^tb\n	��:��0�ፔz\r�{���2���H�4� P��;�J2�k�8��ҽ�����r� ���d\"�)[�;��rL�%P�o;N(�W���#<p	@t&��Ц)�C ���h^-�7(�.�-}R�M�H\r�Ѵ�d�7��3�\\�0�E��Oӈ�b��	�ޠ'������êMJ��XَXu�e����8 ꄅ�R�\n�x֔�)�R�=j@\\W�+����n,�.-R�9�-����H�C ���x���-8�5�C3�9��\0�2`�>7��Q& �C:3���B���8x�!���/�����8�<��SZZ�<R�3�kk\r�#�0�;��H����&w�4�~�4���9�Ax^;��t1��Ar�3��Gj<@���C�|\$���_��������-��0����i��Vx7��*H�6,���`���c���^�0���i�3r��#��x�.���T�ݥ3�+�q��6 �,e�B@��� ���@e�ܠ�@Pj��A�PTI'+�LŇ2<�� lB�5\\����`i5��8�CdoS��/JT;�Bp{�Y�*�˗���a'D����	C(�i)��Gߒ�9萿c���q�� �ʄG\"A�� \$Fj��fy����\$W��6 M��@VBԩ�yf�8-��xS\n�	�\"x�0 �x7!�v�� u!d���|Fc�a��\$��c:�\"��\r��3�Ȗu̼q^q��2l�PĭE�0�ʯJk`���q(���H�w�#�I�%�����3�u䘣LV18����3c�����Tl0�d�:VC҂��{ƀ�lr 4� @I�\na�1�H[��-��x����T�S�O\$��7��¨T��p���[y'\0Φ�34ˤ%X��q��B�'<���<�!�]J�2tab1&,3����s �&qT�H�\0QF����T�Be\"�\rs����\$K!ziİ���0J57	\$V�Rz�Bc(la���QQ�b���<^��.�4�n�EL��Hd��UU�W7LOu8|J ب�2�VyX0���R)Q�,��09�\$��:";break;case"pt-br":$h="V7��j���m̧(1��?	E�30��\n'0�f�\rR 8�g6��e6�㱤�rG%����o��i��h�Xj���2L�SI�p�6�N��Lv>%9��\$\\�n 7F��Z)�\r9���h5\r��Q��z4��F��i7M�����&)A��9\"�*R�Q\$�s��NXH��f��F[���\"��M�Q��'�S���f��s���!�\r4g฽�䧂�f���L�o7T��Y|�%�7RA\\�i�A��_f�������DIA��\$���QT�(_m����z7��ȃ2�jۄ\n¶���\0ԡ��r!�#\"V0�CJB�CC3\0�\$IP�c����H�t6�i��.r�9C�� P�2�@P�2�or�	����*����1��)�mp\"�1�6&\r���I�ܕ���ޯ��+ʽ� @1(06��n3�ܽ��^s�b\n\r8�:�@Rh�&�X@6 ,'�P�-�ʐ�&N�;ohƼ��Z��,�N\$c���3�K	k): �\rR���JT�%�H]9���R���y_��K#=�	@t&��Ц)�C ���h^-�7(�.�-�F�:��\r�(�5�{�7��0���2��.Ut͊�z��0.:�hRF3�M!/ab\n9a6�u/�lܨ�h0P9�)�\n5�a\0�)�B3��(w݄V�s�^L8�^��+�`�߯:J���R�2M�L�\r�]��oH@ ���n��\r&�j44c0z+|��.���}\$l*�83P�Ë\$)������2����L��� ɀ��c��b��F2����;�:����x�х�ά9����}`�j.�_�a�6�\r�~:m�t�F��7�>P�28����Ƭ���+`۽�kT�vt4;�Ʃ�\0�T�,d�d�2\0@0��J-�aÞ!�K����8��K�L��6,�2gCB@�؆�0�P5@�� �@P~m��A0PVI*,�P�2B��(B�A1�6��I�U&�7A�pp���0J@;�r|`\"a�OS\0��T\$�(�C��� (E�A#���%)鄩\"DD^r���`P�w�����V�\n��y&`��h�if?f��5GN�R�cR�'�P	�L* Dh��QC\$p3����A?�ԇ���1^���>��hʙv�<7\" ΢\"\"�3�9y�����ڐC2�1�@L?p�+`@��'ɸ�AǑϙ_�,���2iQ�W��\rX:N��MSid��|u�{�Y4͐�V&�/<(���E4B'+�ǺI�9����~�g!s�\\�\r*4���h��vR(��T�d�j�'!b���_S\n�P#�p��ɒ\r��z��G8�����>~�CE6\r2%}�.���'�)\$���rRfR�:�ԝ��؇ho2A�<����s!M؊�\0U=�ԩΕ��\0k:�N�#��T�LB:�`�Q\"�NR�(�@ޘ�^iQ�\n\r/!��.��F/H��&s���M���&�mK�qJ���@Ԃ��F��O��B?��.�J`M�M1�^�T��L`sQ�#ĕ�";break;case"ro":$h="S:���VBl� 9�L�S������BQp����	�@p:�\$\"��c���f���L�L�#��>e�L��1p(�/���i��i�L��I�@-	Nd���e9�%�	��@n��h��|�X\nFC1��l7AFsy�o9B�&�\rن�7F԰�82`u���Z:LFSa�zE2`xHx(�n9�̹�g��I�f;���=,��f��o��NƜ��� :n�N,�h��2YY�N�;���΁� �A�f����2�r'-K��� �!�{��:<�ٸ�\nd& g-�(��0`P�ތ���7�(*����@�\r�{�0���@� m\0҃�I�~�I�Ħ���5)��4���@Ä	X�0�o�\n*\r)]\$-��¸+�M�c�\"1Ic��)	��\nB�M��8�7��(�ֿ�\$\n�3KĆ�'���S0�\n.�<�L�7��p8&j(�2�L���5��p76L�J2|k/4]G�@P�T@�pH���!�����(�/\n����1�H\n)��-�z`���j9;�JP҈���9\n�:���D�2)��5�\n ��C!l�4����H�����p4*�q��jׁQ��6�B@�	�ht)�`P�2�h�c�<���s]� P�/�M�7=Q�0�5��jt���\"b�B���O�����9�c2�6O�Yu�C�A�����R��b��#8x�@l4�W A+K�C4�]#����ZnD�F->\\�'��h7\rjv��/�@ �k�g��p���`����D�A���1K���}�ɪB��0�9��X�f� ΄:㳯��V�\r��@꞉�\n����P�;�b��<� A���˾�C@�:�t�㿌)Jd�9�������.�_��a�6����qR��K�8�F8/n���S�0��=�\r��q/���s�R\\���� m�4�hI���c&MÓYK�00�c�Bk/f,͚�q�!t��³�I}d�!wV��24иśXR�Ca�~�����0�I81��V���\n\n�CTgq?�W�M�i7hFD@�\nq�Qh��@�xab�W(�4��֐�##a�8,�hN9�;(�A��M	�E(�yUkQ�M���@e�VV����Ԇ��Z�3�\\<�'H�\"�9\rϠ���C�X+A�b���a�i���.ӎrca�u`0���xS\n��ܚ3�y\$XT\\\r��2>PRE�^5BRK�lFo�<#�K�Z3AA��������lVK�p١JrmEͅ0�\n�7d�#@�G\$�M{����JNC�;y�)A�@Ή��rk�D+�F��e���P�0K(aZ�� �Q*\nh9Y�&��P��|	�F��\nC�����I.%q�w����*祥�S)�����!���\n�b�\rd�F�\0�_C{O�ы��^fi�~�:Ȉ���T��!rOL�=RA�?(Ɲ�R�u�yϨ�d`3#���B���18ș2�i�y`Eb�\$����AA�4�µP�UDŒ�yV5*l\$r[\$���	`\r��!WU��!�]���:�}\n8��ۙ���}/�(�����CyZ<��☢jD�eAP��H�Ut����Q�D�tB+�U�z}�s:�	!:���Xdnd����&C6zZHt";break;case"ru":$h="�I4Qb�\r��h-Z(KA{���ᙘ@s4��\$h�X4m�E�FyAg�����\nQBKW2)R�A@�apz\0]NKWRi�Ay-]�!�&��	���p�CE#���yl��\n@N'R)��\0�	Nd*;AEJ�K����F���\$�V�&�'AA�0�@\nFC1��l7c+�&\"I�Iз��>Ĺ���K,q��ϴ�.��u�9�꠆��L���,&��NsD�M�����e!_��Z��G*�r�;i��9X��p�d����'ˌ6ky�}�V��\n�P����ػN�3\0\$�,�:)�f�(nB>�\$e�\n��mz������!0<=�����S<��lP�*�E�i�䦖�;�(P1�W�j�t�E��\$����1�U	,�T��#�ⶋ#�h�����五�Yv���j�0�2�LZj��n;���+��� f���I��A���Ph�҂��\$����2^\$}\"�9	���p�1�a�I��B�<�Tѡ\0;-�\\#.��8�	\$���̼�\$bd��hj�W�<�`�/�8���rZ����(u���3�k���鄣#V�&�M�s����s\re�Ľ��an��PH�� g~�(͓N���B׊�^%U[=���9�2A�M��{�M�V�[�\n���b�jDW�)�Z	�������O�o��1�J���*�y����!�@4}'S*�G+@,K�i�2��xV,����phi+�)��|Y��ڝ~ЪY���iKޛAAo���wd��;���4�Čѥ8th)\$�\0(�>Z�r�k�g��%�#��`�9H��,�Pi��R�\$���\"��J.,D�L�U�ʫ֙&-���˷�@>�AuҴ�Q��:{�#J���9(%?;���*d�A�pa0�X_i�r}���P��f��ہ�~\$�Xx��=y���(>����K�l�8���M�[�?���7�s�})�'z���~&)�!��J���r�5����O���%p\r�@d��N�c#LX�S\nA��|�:�i��3�rIHb�d��J˩ fuqƤ�_&&�l����^�\n\n��0����\0f\r��P�Cpg2��C�,�7���#� ����C0=E���Ct������zxpžC2h��ك('�\\%s�W�z{)��<��xq�[2/3\n]JJ_d,�#���t^��H9!�H\"\r�:\0��x/�L�Ð.�a��P�7C�t�Ѿ>�����V�@����Bd��v�0�����H�L���_�<Lv̥iQX!�yT����T4�%a�5pX�K�TDt),%1�P@C����;���\0b���<F��C*�!�qF��Cc��9�`�J`o���G���0��!�\0n�A�62�uO*G\$��B��� �e��Ħ���V�NƮ��};YJ��\rD>� ����p�Cpe�2N���@�iԘ2�zca�Xt��4��(�'\r�ޘ�r؎��XOA7����T*�9Q}c�wI/���.�H������r�v����7HV�����AF�	T\r�oM��X��'�F�Y(JI���R�R�F�����)F�[i����\"I�rY����Ǜ؆�ӭ>�m8dJv�4�u�i�>&�Dc�9X�\r�\0P	�L*Kӄ�x�~�0�J㏕ګ����P� ��6�.?��+�8|���Z����/\$<��s�1M9���?[U�v S�(�rrR\\/��Z�k0F\n,aL(��z�\n�<w��#@��N�۵�=&����!���-�y��u䵪�rR�gb7~�g=���Y�j���=g��\\���=i��M��]-��,b����n�Y����K>�,:�G+!q�[kL��f먳�\r95�,\n�	B�\r��h\n�j��\r��w��S}�-D�:|2�5>�t��y\$К�6�M�;H�r�;!�P��u;6�'�	m�lҞM<f���c��y�.��^b�k��7&.�7xVy�A2�mPu�{J}n	\r�*X7����5�E�l���rkp�e�\$�;Ȧ@RW�o1m��y��/h>�Tk��姍���v�t�m�d!W��N�%]��BK��%�t�##ǱQbb�Ğِ�U�ޒYmZ��S<��t0�'r�?L���)�}������#���T@Mqzݾ2������� �����0B�&ŗ#?n� ��\n��^\0�ʽV<\$��Ֆ%\0";break;case"sk":$h="N0��FP�%���(��]��(a�@n2�\r�C	��l7��&�����������P�\r�h���l2������5��rxdB\$r:�\rFQ\0��B���18���-9���H�0��cA��n8��)���D�&sL�b\nb�M&}0�a1g�̤�k0��2pQZ@�_bԷ���0 �_0��ɾ�h��\r�Y�83�Nb���p�/ƃN��b�a��aWw�M\r�+o;I���Cv��\0��!����F\"<�lb�Xj�v&�g��0��<���P9P�f����96JPʷ�#�@����4��Z�9�*2����Ҹ\nC*N�c+��<nKd��cY�T����<�F!�c`�����\"�0�K�`9.���(�6���2��I��� �֎@P��DlD��P��\$�<4\r����q��993,P�̓2sBs���M���� @1 ��>���A��\0�֎�P��M�pHR���4'��\rc\$7����-\r�T)1�b])�B�1�o��S�(Z���P�2(Pde˯�\$�Ɛ\re~�FL`���ݠ0�E�?����M�6\r6���=�[�����I�Ck]˥uݶ�@;%-�J=K�@t&��Ц)�C \\6���凎B�m\\(�\$m��PΩ(�7��5Ȍ*/�{*��C3���ސ�cp��p�:�p��9�è�\$�l5��f0����.�Xں���P9�)H���v�X�!\0�)�B0\\Y�\r�\0�Ș۟G�\0�ѹ)NS2�s������2\$#�@�3# �:�\"�@7\rm^Ҋ�8�3�ɧ���f�MD���H2���D�A�����8x�!�K��#~�;EC���:\$�+*dӿ�#���n\nR������c�'n��9@{:s�D4���9�Ax^;��r��?�r&3����<6\\�d�c�|\$���q\$\rçV�Px Y����CYLJm���rzgvO\0002��t�Zg\"��<�BjM��'p�����`�w#���@����B~!��pΙ�>h��TA���U\$\0���/a�B�_L�<'�����b��.��)��G\0rH�^��=E1[O 9������'<�Қp�jS���ڑuRpCa �U:���\"��Gq�Z� G�ょR�B��Y-%�ř7�:�e16'� ���������\0���+O�N%!\$���=�Ԇ�0���!^�q��a�c���\"���2@͜�yf�����b�	<K��\0�¤[b����S��/�!���,��L���T����u8�x5L�â!fr���ƶ��\r������Q	����x^�\0F\n�@����K�L��>b&�ҕ���Oi�����z�v��ĠA�jph@u;�=F�uL�a)���wE	)P���S�vA�;�XJBJ\r��5�@��	3�ɔV�b��(A]GI����)�|�A��ZhU\n���؂H��%2j�5WXz-�9p�5�cPF]J�\n�R}�^M1���5�\r��v��8S\0`�Iw�b2��>�QS2a6ĆdYQJɯ.Z6�RF�\ry%1G��6��RM��\$3�чFfF���@\$m=�k�y�9)	�M?�'<\$z3�e���LB3#H����S*ږW�`%�N�3<�`'PThS���0��1�����\$�S�q��s�m�&'HK^`јR����ܣ��\nI( ";break;case"sl":$h="S:D��ib#L&�H�%���(�6�����l7�WƓ��@d0�\r�Y�]0���XI�� ��\r&�y��'��̲��%9���J�nn��S鉆^ #!��j6� �!��n7��F�9�<l�I����/*�L��QZ�v���c���c��M�Q��3���g#N\0�e3�Nb	P��p�@s��Nn�b���f��.������Pl5MB�z67Q�����fn�_�T9�n3��'�Q�������(�p�]/����mg���e����\$��)���]6���k�l��N����c�5�CH��� R�:��h��(���#�	�*E��(�6�����b���\r���2�ò>�\rp;�1AE\nx�ŀTR9�\0S�4��(2�B�Z5#̜��¢p�� �(��{�1&#��s(�3�#RK6\$�-�C�4-\0PH� i>�.�����Z�9'�ӈ�\$��&<�\$*\"GZ��:�+(�h�0�+��2B�l2�RS(�\r�l���-�ƞ��Z����-=P.�H�Z!i����5�B�W�d9�S@A]S��Y2C\\4V�%�c\$�^=%P\$	К&�B���p�c��9���� o��W\r�p�1�\n�3�Ҡ�E�,N��rjL9����S�p��\rØ�1�l��3�`@�-���b���6�tj7�P9�0%P�I��87��@�)�B0\\W�d���ې�!��խh��rjn:�c�P��x��U�ޒ93Û�2��M=#ߌ�#%4��X2���D�A�ɷ�.�x�!�UJ�/YZ�o#̌�5d��I����l:�샄:9���r<A�և���.�\r��8a�^���\\�e��\\��{��᷅���	#h��Ńp����70\r�vS�\"H��X����\$�XQ�0��)\"M��8ބ�\n��4 Cƒ��\0�P�K���,>��39�(���sc셑��h�â؂\$9�Xz{ᤏ�2^�)�o���b�Ξ��|AȒ��F~��h� (\0PRI\$�T;�p�xCm�A��s:A̱�K���JdI�\$�/3br�J��9�ufMH�Bj��7�zn�i[�48�\n�	��\r�g �b�\nM�\"&LY'n1A'���by!����yH�iw-�	���H����x̵B\nNIْ�P���nxS\n�-1P�u�,a1��/�IH�&<�X�S����_�1�c>H\r� &�3�\0�B` ʄ�n��5!g��~��z+I�ș�)<���\r'P�AP�9��-q\$��(�;�T�E�!l�b�=�R]y��e��g�S!N�\n���/I�dP�7C�IY�ք&�B�i��+b�,�:�R�AE����tͩ8/E��C �oԱ.Aj=��O��\n�P#�p��sn/a�3��{R�%>��LU�jx��+\rgUBJ��X\$5j,�ŵW�9.5��F��WL-_f�`�T5;	�.��(��C0y,�ؘ����v~�09��M��6A��Y�A���1�\nSJ[��4F/SBJK�`o�\$d����UK:\$\0تSlpP�C.��և�B\\�\rp����U�Ҝ+C��ÜJ����\n	d��(�P5b@�%A�yl~�E�Z���^թ}����R\0";break;case"sr":$h="�J4��4P-Ak	@��6�\r��h/`��P�\\33`���h���E����C��\\f�LJⰦ��e_���D�eh��RƂ���hQ�	��jQ����*�1a1�CV�9��%9��P	u6cc�U�P��/�A�B�P�b2��a��s\$_��T���I0�.\"u�Z�H��-�0ՃAcYXZ�5�V\$Q�4�Y�iq���c9m:��M�Q��v2�\r����i;M�S9�� :q�!���:\r<��˵ɫ�x�b���x�>D�q�M��|];ٴRT�R�Ҕ=�q0�!/kV֠�N�)\nS�)��H�3��<��Ӛ�ƨ2E�H�2	��ך⚓�E��D��N��+1�������\"��&,�n� kBր����\" �;XM���`�&	�p��I�u Q�ȧ�sֲ>�k%)+A\"�J�\$��<�t��KV�2Q�0�1�L�h�HI�JtAC�`�)Q���N��\$۽r�c0�K!|�5Hu�	���Js!PF�D�<S>�J��)r�cQ��\"ϼ�`\\�j,�_�L�����\$p�.`PH�� gh�+]J���:Y�,�\$� ��Z����?o=V&��\rT�	��w�5<*�3��XȤ��\nJ+q ���n�����Ԑ�N�D&�*�}���*�,e��CQ��JI�\r\$�Au���/jh�c��K��H�+�d�ik�b�)�)i�e�dK6q�-��3��\$	К&�B��� \\6��p�<�Ⱥ�_5�9��c��C`�97-�@0�N�3�d\$2�*B1'\"�,oEY\"���\r��<���9����c0�6`�3�C�X�\\`�3�0�A�Xl\$:��@��j\"�!�2|!�b���e�?k��\\n����Sf�	s����Q���Y\r���ۨB�|7\rnx�7�\\h�	�\0�2uCp�9s��Ǎ#'��{����D�A���γ���0��ֺPҵ\"&���Ujё1o,��ϓ�`��5'���ǐP�hag]��Dû�WA�<\0��Z��~���?���p`�����pa}\r�9���xe\r�\$<w���{�`�\$���r�lJ���\"��\r����\0��i�������kEH��E�ȡQ�����/R؃ �@���y��\n{G0�0�_x �)�#�[�Qe]�		�ra�ʹw2��4�;'@4�b� p�-���k3|�#��gU�(�!ᣔv��c�#\n�q\n�H\n�b���Y�K���#���{�ϐ�C�rQ���8>\0�s���\r�[���:݉2v�4��ST�Z�O支��2�I�^P5N��k��l=�\r�<��Ub�쀪	�a�@�a�+�j��PI\$!�G�<�Xs�Q����C�΍a�9�����|'f%K'5L�d��6�:IHI�\n<)�I�ڌ�3c��V#I���!)x�մ��f�4}En\0�Rbj,��-O�q��z�y�����oS��f��z\\�x�S���!70@�K�\naD&\0�:A�~�*M7��LV�Ξ���L������kv76H�P*\$���pImjL�H��Mm�\r�.1~�O��H�Vʢ��з	���,��ܲ��ٴ�x�AI]6wuO��A6���cf�o\r��	�!t��\rp��Ȼ��m❣/8k0C�#��7\0�0-\0�%>�\\����4 ��T��\n�<�W�3|,L����FșO�o�)�)�|�CJS��^S��P36b��\"�(&�0��ɏ.�5aG�<45�Jhr���ڥ��|I�e���g~��UV���bS����+peX��\\^I�����`��ns5�[&,���A��bQc@S(\\H��(�H\$2���oup��yZ(��N\\��i�n\"ʺz����<���V��P5�_2�����9d�4�%��h	 �ы\$h=8�H��";break;case"ta":$h="�W* �i��F�\\Hd_�����+�BQp�� 9���t\\U�����@�W��(<�\\��@1	|�@(:�\r��	�S.WA��ht�]�R&����\\�����I`�D�J�\$��:��TϠX��`�*���rj1k�,�Յz@%9���5|�Ud�ߠj䦸��C��f4����~�L��g�����p:E5�e&���@.�����qu����W[��\"�+@�m��\0��,-��һ[�׋&��a;D�x��r4��&�)��s<�!���:\r?����8\nRl�������[zR.�<���\n��8N\"��0���AN�*�Åq`��	�&�B��%0dB���Bʳ�(B�ֶnK��*���9Q�āB��4��:�����Nr\$��Ţ��)2��0�\n��q\$&�����*A\$�:S���Pz�Ʃk\0ҏ��9�#xܣ��U-�P�	Ju8�\r,suY���B��.��'���I-\\����W\"�u,�ͱ���(��J!\n��7\r�/֑<�-�2�W*��{cQkR�T�P��+C�+�c@٥+�-V���淺�ԭ�b�(�6���T�����ܭ��Bҍ\"���M)^�H�T�����2�U���T�ީP�aj��Y%�\n���Q	T�db�&GX��bR�kH�V\r��SluH`H��_�c\$eh�\0HK�R9Y]l6P�J�����<�PH�� g��*���G5�\0L��\rP�Α.U�tl���yW�1D�/�B��D8���[�|ܥL�	)�J�O.�~�ƹ��T�m��͐�z���΍�Hz#˯D1�H���ƩO\r�����gF�.7�S���H]�h�����h�Z�����Y�]��}�h�9�D2 �&�'(WcY��\$	К&�B��� ^6��x�<��Ȼ�B-���W��z�1JLʦ֣e>���!�����bH�p�hU�� ju�g�ڪ-�p�,�y�\r��7�@S�ua���0�C` (a�\$0X|C�&!�0��A�0mI�����\nJ�C\naH#�fa�B�D.��8�V�B �-��Na�t�5\\�rh�s� 5�3��وD�+����H�#��ϴ��#��\"����Bt���\r���`��:|I � �H��d7i�>F�a;�3�D`>���\$��xa��v���&�f���[�)���(�_b�I¹\\�x�YA\0eM�����W�hag�H	�ü�g��<\0�\$\\�2�2�PD�t��^��.(�]���xe\r�<�\$���|�`�\$�sػpt�ȿ��~C{>>@����C��a��LQh��t��k(�6�آ���I�I�;F �K㙌�<�@�x�c��7\0�z�b<A��H���a�p�B�X�t0�A�TZ�~O�?\$�v\0�:(C!�9�&ڸH(���9��\\��PZ+�cH��H\n\"�ǈޛ�#\0NM)�0�^ι�7�(!��1P�q�<������Y�p�������\rk(a��)����*1���҈`��W�*Ș�lkʋ�\n��lΣ2\r5�ʚ<ي�j���u���U��)���A'�˦Y;��i�4y�Тa\\I�����ӹ/X�9dF�*R�չe���f�:Ɏ (\$���w\0d\r,��R���>8�S�HC0r]rRK@� ~hf(l.��i�{�����_{���&\n<)�K҈n����6d�⸝y�_F��_�s3�f;*����r\"�sȨe~F Q&�pf\r!�:�)Z��L��`�׼a!���yl�@�\$'(E��\0Ŗ�\0S\n!0e��T��R��F|M=���c\r�Ag�X~�9\r4���#\"WE�������ޒ`��&�5ӿ���MM1�f�P:N���\nI�\r���4��5��v���:mg�����Ξ,��W�Fc��L;�]�����Ɯ�}����)�;(��`+p\$1��A�%v�xZ�Q�2C4&�x#Y�8f�v��*�@�A� �Ro\$���q��W~��p����\$9MyS=2ʗ9�ܝb��1WZh<�\\�4�8�8l(���zh������͵��.18�MSn�o�Y���E^@S�,cGL�X�o@\n	��|��u9�k&�����~����� �2�{a�M%\"m����\"\\�U;��9��� �g�N�����_�%ȡ���j�Y�&gM�0I� +ʔY\\�9���,�6�A��.e1��H��z��,���>VYΦ���W�-��o�g�2\$�~De޷eL0�!�?4�-��f�#{���d���>����~�]�tdB�\"��D�b�.��?1sKz��ܧ��\\kZ(���&�e�1 ";break;case"th":$h="�\\! �M��@�0tD\0�� \nX:&\0��*�\n8�\0�	E�30�/\0ZB�(^\0�A�K�2\0���&��b�8�KG�n����	I�?J\\�)��b�.��)�\\�S��\"��s\0C�WJ��_6\\+eV�6r�Jé5k���]�8��@%9��9��4��fv2� #!��j6�5��:�i\\�(�zʳy�W e�j�\0MLrS��{q\0�ק�|\\Iq	�n�[�R�|��馛��7;Z��4	=j����.����Y7�D�	�� 7����i6L�S�������0��x�4\r/��0�O�ڶ�p��\0@�-�p�BP�,�JQpXD1���jCb�2�α;�󤅗\$3��\$\r�6��мJ���+��.�6��Q󄟨1���`P���#pά����P.�JV�!��\0�0J˶���2�\\�+�b�:H�dԭI�SŒK��QZ\0Q�L\\N|�9�Æ�7��[%B�#b�Qi(Îp{��*\n�\$���ē&�4����99E��/'�ʍEē�q.Bh8�0b76�\nzL����M\$#;r�j��R�\\���ʶH0KTXC��f��L}��ET}En�j�z��S�*�������j�wR9.ې�9VM~���x�ͳ��^\nL�EWs�j\\�{E,�B� ���gy���T�bx��PӃ,Ŋ�g(��F�ދ�*�\$#\"L�CIr�/���A j�����(b�Ҷ�r�D��4�[����L`\\c�l���{��ʙ�V������,��d0��jvʫ76�\\R�^#��u;��%�k1ij��[Ƶ���e&����E��1��K����	@t&��Ц)�Rr�\nT@_�m{��mYpZ���\0��Y����(6���=C����0�6J�+��jmVd\$b���[�c�CMȨ7�Ch�7!\0�7c��1����:��\0��:U`��'�C8aJ���VtR�u@��9�������;�QF��\0R���0����[j\rͦC��^APL,݀����ͺ�A�1ӄ���7�؟��F���OK5���{pk?��7�'�Ҩg2A\0�C�a����\0<'��`z�@\"��2 H�xa�`)���4lH�7>lE:��\rQ5�DċSd���cxt�c\\;p�àCs@�X8J��:��8��ti�a�6����p`����/�pa��d9��xe\r�\$< X�|p`�\$���~Cl���=)�A6P8ogG�o��{�Ht>q��E���55Y�r��T���9ň��A�!�:G�����������gA�3J0@�_��o���BP9��4\\0͐@�|�\r!�6)�\nd��CP�C�����/:�5�SD��Y�w'en�\0�\0(1\0�A�Bࢉ�;f�q_&)�p��3*�\\8��\$Y?���c�~�+:T:�||ꥏ�;֔�\"-y&2+�{\n`�1턮�W�!r�-���5���USȰ����p��3W�4���SI9V���2���X	\$�<��@#5p�A�eN4^�q��u`��l[�q~+ y�I����U�R����d1k�8�B����%<b(H��v]�2���)A�;Ca�� Y��2QiAj\"����:�[�����a�Xu\$c�qQj��A��y�pc}��k���#Xb\r1h)��5g�5�`�R{:\r3Z�@�{o�\r�G�b��d�\\'��d�*h����CJ�45���a�5��!M����3<n^��ܣ�������!�F0I�5�1��{Ж�9M ����\r��1����i\09�i�e�T��N5�`#a��e ��2��P��h8*1��V s;;i59c#�Wr�ͯ;2*�uS˽Rf%[7C�v�\rSO�*����C0yʥ��2��\n��M;��ö��\n�r��}+�P���K)���,�s���'9�I�|O��ZVieگ\$%������3@��{�[�aE���Q�\$K���F��S�;^�+H�](��)������F��M��+7X�b��֛�M=�H��WuK1<�%�}�zȿD��_�\$�XQ;�";break;case"tr":$h="E6�M�	�i=�BQp�� 9������ 3����!��i6`'�y�\\\nb,P!�= 2�̑H���o<�N�X�bn���)̅'��b��)��:GX���@\nFC1��l7ASv*|%4��F`(�a1\r�	!���^�2Q�|%�O3���v��K��s��fSd��kXjya��t5��XlF�:�ډi��x���\\�F�a6�3���]7��F	�Ӻ��AE=�� 4�\\�K�K:�L&�Y�@u=vΓ�a��?2v�Ƙ�@k��h�D�/�:L`��yҐ��S��>c�:/�B��l��-�0�45��6�iA`Ѝ�H �`P�2��`�	�H���h�`���H�@o�} P��\r�,D�\r++���@��0P�2#�-HJ2&���r��ԩ�܌�� PH� i2�0��\r�N1=��<��j\n�%�(R�����2�k�Z8\"�dD�#��b�8#���b=��r��AШ�2�҉�K���R�\$WMRix�O�K(�6��X�� t9�\"��]�\"�Z0�!h�3�B�^�P86D�Q�C���`�,���>c�N)��p���:|5ڋ5�Ä0�=<�\0ޝ�C�r0�p�l7\$C*�#��2'��\"8�H֋�n�?#[�9^�mDVJ<�4a@�)�B0R\rL�2J6�c.�0��N'��������v�-���)8�2 7� �@��l'�ܖ?+.T5�-�:ч���9�0z(�|1:9b�߃�105���Ȳ!�^0��~b܎pM��uX�b�:����ȋ_Ϥ>7\"�pͬ8��^k��2�#6F�{Z�2ͥ��A��:��:����x�م����(��=�����3�냘|��i�1omۃ���v��:�-�;����ϸ�p�s��x�CS�E�0O��Wì��6�?���h�����fW�N���rL)M�6ʉ	e�\0��0�� U<!�\$B\$��i!_(��r �Ad��0PQX�m3i�����T\n�T\r��<�p�[�J�L�AP�a�a�<�2����ȹ%�����II:#��Ɍ>���O[�~A����V@�a0 g�u.�.�ܒPt �0�Qb�� 	����7�H�#=Ǚ\$D2Nb���{@���p�	�)�S�x����!�D�9�%��8pH�Ip���^�x3@'�0�kH�o��<�u�[A&�����%	#����C:�{ǘ�6TG\n��R�@�/�l���^>��L*'�5�C�g�zq7��n���zHn5��9�\r'4��9\r�`0�d^#)�d�J/\"X�X<�7F�1)�C\re	��r�π��c�-�)O�.���E��4NZH/�@7R��T����+�[��Ç�PI=JuB���c{<`J���:@��9����\$!�V!�#�O	�CHt���<�%]/����F�Q��,�V��a��i��#g�2�]k�0�ID_͇H�I�����n/\r�F��>�z�3�>}'���BXoYE�R\$\$B�)�p�j��o��\nZXY�UK��0�\n�9B�m��q@";break;case"uk":$h="�I4�ɠ�h-`��&�K�BQp�� 9��	�r�h-��-}[��Z����H`R������db��rb�h�d��Z��G��H�����\r�Ms6@Se+ȃE6�J�Td�Jsh\$g�\$�G��f�j>���C��f4����j��SdR�B�\rh��SE�6\rV�G!TI��V�����{Z�L����ʔi%Q�B���vUXh���Z<,�΢A��e�����v4��s)�@t�NC	Ӑt4z�C	��kK�4\\L+U0\\F�>�kC�5�A��2@�\$M��4�TA��J\\G�OR����	�.�%\nK���B��4��;\\��\r�'��T��SX6��VZ(�\"I(L�` ���ʱ\n�f@���\\�����.)D����(S�kZڱ-�ꄗ.�*b�E�D��~�HM�V�F: ��E:f�F��(ɳ˚l�G�(�'R���dX#D��#�a�+�a�P�����\r2�	���Sd����욲�(�b4Q�f���U��x�)�a��d����T�C)\\Ҡ�c\"�,Ix��u��Zv��[U\r�dW��4��PH�� gt�5�D5e�4X�j8Zݡ(�1 �D��E�\"�J�},JR��z+5�P\"��h��әi�*jH�����=���7c%q��<dT�eck��/4)j�j?L�,���&��J���NK�F���j�����49�s���b��7z\"b����3\r��^r�1�ZSa��oF��th�f�L(ҘZ�axt���T]���Z�C`�9N�0�N@�3�d@2�t���;�o\n�{��\r��@:�Ø�1�n��3�`@6\r�<@9ǜ?D0����D8@6���aJ��j�\"���)��;��\"9������Rdb�S+�)�D�0\"V[�hԃD�}\${I�̛(R��	���[��xrta�p@C#�\r��9#���(i�0��qhf���� | �݀���|�Pz�7+%�2\\d��7*\"1\"���1.��&��N�2��\"��*r`f�zkPA���C�ހA�(0�\0Vpe�4����`��h���s@��x��	ra�@��(n���A ��s�\$6��c�t���,;��xz�;�0���C�́��D�WD�5c�L��E�S�K%\$X6 ��A�!�:� ��u���\0��Y��3E\"0��Hsun�׻{.Oז\$`0Ȁ@��\r!�6%��f͹�l�I*J�d4\r�!I��(��gQJf�E%pPY�L=|���5�P��������k:��nA ���� \\���\\�ӞtN�eY��\0�C�x�Ho�3q�z4��q�l��X��,RںCDB���Z�>��_B�_�L(��CzH�!�M�愤E'B�I����-��Z�9�H�CRR�\r�JEuxH�y8@�2A*C&C�y�G��8��N����7���\\<�k�\n�4�T:�����D�Hq\$*fUd�b�ؼ@'�0���+̦�\\��2\\��5��`�C>���s�V�!3VȮ�z�+��z�BIL��Md������x�4e�K�\n���;N�8�.�L\naD&\0�FЂ�*��pi��u�W��_��r8�ь)��)ڔ�Gϵ������43����/���(%�>�*J�3:CE���42W\r�qh�i���0�A��g���LV[��\r�PH�Z��ø�9�*��`+Mom5�KkQq9\rN7�S>;-��2'MD�;��5�\r��(�	x��U\n���A`}mD\$�)Ct���\r)Ȉu(��KXg����u7��>lky�3,�M�v��al����pNNo��@H��&�.�bh,��+&���ɏ�%�2[K�(�=\"�^�Se�D��+�\0IR�~�(չ����E���#c�1&J&���U�x\n	����r���[S1\"%.�T�\$GDh�T�NnQ�{��(���z��+�����Ŕ���|�T:N���J��mj�D�@�z\$�l�ڛ�S��x��`��yzV�L�1M�gㆋt)�s�V�\r�E\"";break;case"vi":$h="Bp��&������ *�(J.��0Q,��Z���)v��@Tf�\n�pj�p�*�V���C`�]��rY<�#\$b\$L2��@%9���I�����Γ���4˅����d3\rF�q��t9N1�Q�E3ڡ�h�j[�J;���o��\n�(�Ub��da���I¾Ri��D�\0\0�A)�X�8@q:�g!�C�_#y�̸�6:����ڋ�.���K;�.���}F��ͼS0��6�������\\��v����N5��S��ܓ ��g	��p�7���v��#�]���]�+��0��Ҏ9�jjP��e�Ad��c@��J*�#�ӊX�\n\npE�ɚ44�K\n�d����@3��&�!\0��2���0�%Ť���b��CC>4�j�V�4����:�oĚ&��Ꞁ�-ɈH���L\0P�2��;��D�&�2I J�3��\"�<��(P9� S4j�!hH����V:c[�_�K�J��i�S(�er�EzP<:���i#聁BB�+��c�2�S�^��I�Y�6Gs)w3��M�<�ՁS�a+�fP���G#��a\r<�l>4E<��X\"@t&��Ц)�B��\"�Z6��h�2BŐ����2\r�@,����9�\0�3�c�2��!CY��OE;����k��Z�v�8���|����C��ލ[46@�`@��q�:�h��j�Q��a�O��ʌ9,�S'��(b�)٨ӣi�c@�2ZH1E4�EX�\\P�;����\0003�cD�5�a\0�7�A\0�9�h؂2\r��p2�Hx�����J@D�\0�:q��^0��p�zLiQ@�JjwCO�~:m�}?N͜�i�?6El��N7~�꿵�Zsz?=�\r��8a�^��\\0��]��x�7}C�\"7q�\0_Ўa�� �\nd�v}WX���?O��@`	q�GũBF^Si������Ccu\0u��eÇ �Tpa�Eć0��a�:�\0����t�1�	�+s��؅Y�Cp5�bp�PZ\rI���q@P����(��M9�#�\\��4L�z�(\0007X4�H�i�4���C<(jN :8P��Cpo?��xPR�� gE��8NZj`Bp�d�T�X.\0����(��@W����Rе��v8��(������8��������s -����D��=a�GH��Z�^���&C1�:n=���G_Y��\"08P�c�.�E��B}J!,�@'�0�ië?h���&�\0��&�v�rrN�)=��[�	/%,bb�+���I���Br�����	W���&3�]�0T��=�6ßC�\$N'��ĉ3w\\\"A\"���)�gm���Jp�N��)���I*��aw�H]�T>��� ��B\nH����L��\"�\0HI�B���Th���-��X��D� U\n���~�����ș9Ƚi�t**\0��{��'��YD^Ι���((�T���0\n�&\"&���&9���ҥ@\n�V�]]b,͔Sj�X}A�5���4�l�Zal�1�4r����� ��'�\"!��\$��؍\r�\\0҉b�B�#J��9�\r�T�j�S�:_b�:*���V�eEoz85��X�	\"������";break;case"zh":$h="�^��s�\\�r����|%��:�\$\nr.���2�r/d�Ȼ[8� S�8�r�!T�\\�s���I4�b�r��ЀJs!Kd�u�e�V���D�X,#!��j6� �:�t\nr���U:.Z�Pˑ.�\rVWd^%�䌵�r�T�Լ�*�s#U�`Qd�u'c(��oF����e3�Nb�`�p2N�S��ӣ:LY�ta~��&6ۊ��r�s���k��{��6�������c(��2��f�q�ЈP:S*@S�^�t*���ΔTyU�x���_�\\��ۙT���*���Ӫ롄Ҏ�'�a�[�Nb��*��V��d�>1[��vr��q��¬!J��1.[\$�h�Dc�M��Al����N-9@��)6_��D����/K��L���>���A^C��1zJ�g1@���2\$���]�Q;�!� A\n�RX<�@S.��\\tj����ZIi9vs�zF���\\���tG��a#Fg)T �@'1TÅ��H\$\\�%��Jt��2]�%t����G�5<���	X�i�!aؤ��tܪB@�	�ht)�`P�<܃Ⱥ\r�h\\2�UOT�s�K����Ʊ�\0�92�x�3\r���ڥ�yP�o��Y�I(���{06�#p��p�:�cD9�è�\r�x��acH9b��0��cdk�:�a@���,ND�)�NR�I�\$96�4�r����a�<HTD�*2Cp�ь�x�n��#&l7��T1����2n!\0x0�7���J8D��U��x�6��>4 ��b>zn�KLū.�h�9�{8�юc��;���4߃ ]�o�F��\r��8a�^��\\0���l�8^2��X���ۨ_��a�6�����O�4~�Z7��.j0�l��:3;�)�\rç��')~B�%	vtEZ+�yv%��ʆ��n��20�eC�ql���`��( clu��F�Y<\n�����*���ؽ��C`s`����\0��yq��J\n�̚	� \n (l�R(������CI�mո@v�i��3�x�T�0t4f����(w������!�j�1��[W(K��20\$ԛ���G0��ɦ��y���ByQ\n�cI+�27x����|��ѯ��M���7����[�g5�2�Y3	c#�4&Ԙ���O\naR#x�J�x�(\"Ey�<^�\0��R0EH�H�R�Xr�<.�!�1�@1�V0�C{�_@�1��L�.:�0T��U;��Y�����L�#(��B�<�R?�r9�ً.�<Ya6-m�(�PÞ`�(,��C�F�(���7�b9D���K�6���CkE�ha(\"�5|��31w�mB4�\r���NG���T����\$��6�к�9Ex�:&0��z��P�<�ܺ���N���%=M��\n,�@��(��^^��=�(��\$���ȭ[�\\9����c�@�'\nv\r��ʚ�b���mK�P�Q�'R\\x!\"8�������y UAB#�e3�/�HS��Z�B�Պ�`�ATI�s(�(�*�Iǖק*�r\rb�";break;case"zh-tw":$h="�^��%ӕ\\�r�����|%��u:H�B(\\�4��p�r��neRQ̡D8� S�\n�t*.t�I&�G�N��AʤS�V�:	t%9��Sy:\"<�r�ST�,#!��j6�1uL\0�����U:.��I9���B��K&]\nD�X�[��}-,�r����������&��a;D�x��r4��&�)��s3�S���t�\r�A��b���E�E1��ԣ�g:�x�]#0,'}üb1Q�\\y\0�V��E<���g��S� )ЪOLP\0��Δ�:}U���r���yZ��se�\\B��ABs�� @�2*bPr��\n���*�.�Oc���D\nt�\$��O-�1*\\CJY.R�D��L�GI,I��I�@H��ő�[��)r_ ��K�j�����)2���ft(q�W���s�%�\\R�e�pr\$,�1�#�ē�IA5er2���R-8�A b���d�8�-�!v]��!���sđ�]�Rx� �i����D@�!QsZH\$kI�a|C9T��.�'�%p���!�C�Il+-�Vd<(D\rk[�e�\"s���	@t&��Ц)�B��u�\"�\\6��p�2Uui&C����\r����2�\0�93Cx�3\r������t�*�/0�vh�7��h�7!\0�7c��1���:��\0�7����5#�:0���f�,�6�ì�?7H�4J�	�!�b��ԍ�X�7/ϑt��k�0��`���]�	�O�x�\"*2�p���x�n��#&x7��`1��\0�2o!\0x0�� ��J@D��_��x�7B�J4�(Y\$	��f��j�>�6�\"h�9�x�Վc��<���4�� ]�p�G\r�\r��8a�^��H\\0��P�m�8_��c�a�o�9��H�84�n�:r<��|M��<5A5�g�=��[��:r��2r��@\"@�c�J�C���A�!�:9����e!����C��O�3:�@�Y%d쥕��M���0|0� @���\r!�66�FP\"�! �c��RB�\$�a(+�0��(��P:	Ah4���CI�m��@����4F��'��ۃ��6�l7�(h�øewD^4F�9�0��,���-��%���4d49�p�EB�Bj\\�?(%���4�9DP�B�\$�`@Xdo��6��\r��`��:�w���o\r��淆�l�|/er�F�^i��P	�L*�^�?RH�ap&�z.� s�,:��/�4bb+H1���əP�����\r�1�'���Q	��334h� F\n�A���^�h~3�X�9L���<¥�'1Ν\\��g��,�d9�ش:)�:5����y���<WI�XΐS��@G��b�\"|_ť�Xca!�5�2��4���6�����i\0(#Og�]by3L�*�@�A� i��Q�t��(�J)�����^��Lr�@PM��!Q	��!�P(s�zg	��:D��¤�{Q���Q�� 9���#�\"'[;m�h�`fcrTB�@��9\$E��:��Ҏa \"\r��yUVQB#�e4�29aH��%����:ƙ�n�\"�U�e�4ӭ���[yE�\nP%¡Z��";break;}$sg=array();foreach(explode("\n",lzw_decompress($h))as$X)$sg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$sg;}if(!$sg){$sg=get_translations($ba);$_SESSION["translations"]=$sg;}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$errno,$error;function
__construct(){global$b;$Fe=array_search("SQL",$b->operators);if($Fe!==false)unset($b->operators[$Fe]);}function
dsn($Ib,$V,$G,$D=array()){try{parent::__construct($Ib,$V,$G,$D);}catch(Exception$Wb){auth_error(h($Wb->getMessage()));}$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->getAttribute(4);}function
query($H,$Ag=false){$I=parent::query($H);$this->error="";if(!$I){list(,$this->errno,$this->error)=$this->errorInfo();return
false;}$this->store_result($I);return$I;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result($I=null){if(!$I){$I=$this->_result;if(!$I)return
false;}if($I->columnCount()){$I->num_rows=$I->rowCount();return$I;}$this->affected_rows=$I->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($H,$q=0){$I=$this->query($H);if(!$I)return
false;$K=$I->fetch();return$K[$q];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$K=(object)$this->getColumnMeta($this->_offset++);$K->orgtable=$K->table;$K->orgname=$K->name;$K->charsetnr=(in_array("blob",(array)$K->flags)?63:0);return$K;}}}$Fb=array();class
Min_SQL{var$_conn;function
__construct($i){$this->_conn=$i;}function
select($R,$M,$Z,$Dc,$pe=array(),$_=1,$E=0,$Ke=false){global$b,$y;$kd=(count($Dc)<count($M));$H=$b->selectQueryBuild($M,$Z,$Dc,$pe,$_,$E);if(!$H)$H="SELECT".limit(($_GET["page"]!="last"&&$_!=""&&$Dc&&$kd&&$y=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$M)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Dc&&$kd?"\nGROUP BY ".implode(", ",$Dc):"").($pe?"\nORDER BY ".implode(", ",$pe):""),($_!=""?+$_:null),($E?$_*$E:0),"\n");$Mf=microtime(true);$J=$this->_conn->query($H);if($Ke)echo$b->selectQuery($H,$Mf,!$J);return$J;}function
delete($R,$Re,$_=0){$H="FROM ".table($R);return
queries("DELETE".($_?limit1($R,$H,$Re):" $H$Re"));}function
update($R,$P,$Re,$_=0,$N="\n"){$Og=array();foreach($P
as$z=>$X)$Og[]="$z = $X";$H=table($R)." SET$N".implode(",$N",$Og);return
queries("UPDATE".($_?limit1($R,$H,$Re,$N):" $H$Re"));}function
insert($R,$P){return
queries("INSERT INTO ".table($R).($P?" (".implode(", ",array_keys($P)).")\nVALUES (".implode(", ",$P).")":" DEFAULT VALUES"));}function
insertUpdate($R,$L,$Ie){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($H,$gg){}function
convertSearch($v,$X,$q){return$v;}function
value($X,$q){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$q):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($lf){return
q($lf);}function
warnings(){return'';}function
tableHelp($C){}}$Fb["sqlite"]="SQLite 3";$Fb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$Ge=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($s){$this->_link=new
SQLite3($s);$Qg=$this->_link->version();$this->server_info=$Qg["versionString"];}function
query($H){$I=@$this->_link->query($H);$this->error="";if(!$I){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($I->numColumns())return
new
Min_Result($I);$this->affected_rows=$this->_link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->_link->escapeString($Q)."'":"x'".reset(unpack('H*',$Q))."'");}function
store_result(){return$this->_result;}function
result($H,$q=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->_result->fetchArray();return$K[$q];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$f=$this->_offset++;$U=$this->_result->columnType($f);return(object)array("name"=>$this->_result->columnName($f),"type"=>$U,"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($s){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($s);}function
query($H,$Ag=false){$Td=($Ag?"unbufferedQuery":"query");$I=@$this->_link->$Td($H,SQLITE_BOTH,$p);$this->error="";if(!$I){$this->error=$p;return
false;}elseif($I===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($I);}function
quote($Q){return"'".sqlite_escape_string($Q)."'";}function
store_result(){return$this->_result;}function
result($H,$q=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->_result->fetch();return$K[$q];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;if(method_exists($I,'numRows'))$this->num_rows=$I->numRows();}function
fetch_assoc(){$K=$this->_result->fetch(SQLITE_ASSOC);if(!$K)return
false;$J=array();foreach($K
as$z=>$X)$J[($z[0]=='"'?idf_unescape($z):$z)]=$X;return$J;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$Be='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Be\\.)?$Be\$~",$C,$B)){$R=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$R,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($s){$this->dsn(DRIVER.":$s","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($s){if(is_readable($s)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$s)?$s:dirname($_SERVER["SCRIPT_FILENAME"])."/$s")." AS a")){parent::__construct($s);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($H){return$this->_result=$this->query($H);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Ie){$Og=array();foreach($L
as$P)$Og[]="(".implode(", ",$P).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($L))).") VALUES\n".implode(",\n",$Og));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){return
new
Min_DB;}function
get_databases(){return
array();}function
limit($H,$Z,$_,$fe=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($fe?" OFFSET $fe":""):"");}function
limit1($R,$H,$Z,$N="\n"){global$i;return(preg_match('~^INTO~',$H)||$i->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($H,$Z,1,0,$N):" $H WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$N."LIMIT 1)");}function
db_collation($n,$db){global$i;return$i->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($m){return
array();}function
table_status($C=""){global$i;$J=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$K){$K["Rows"]=$i->result("SELECT COUNT(*) FROM ".idf_escape($K["Name"]));$J[$K["Name"]]=$K;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$K)$J[$K["name"]]["Auto_increment"]=$K["seq"];return($C!=""?$J[$C]:$J);}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){global$i;return!$i->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){global$i;$J=array();$Ie="";foreach(get_rows("PRAGMA table_info(".table($R).")")as$K){$C=$K["name"];$U=strtolower($K["type"]);$xb=$K["dflt_value"];$J[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~'(.*)'~",$xb,$B)?str_replace("''","'",$B[1]):($xb=="NULL"?null:$xb)),"null"=>!$K["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$K["pk"],);if($K["pk"]){if($Ie!="")$J[$Ie]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$J[$C]["auto_increment"]=true;$Ie=$C;}}$Jf=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Jf,$Kd,PREG_SET_ORDER);foreach($Kd
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($J[$C])$J[$C]["collation"]=trim($B[3],"'");}return$J;}function
indexes($R,$j=null){global$i;if(!is_object($j))$j=$i;$J=array();$Jf=$j->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Jf,$B)){$J[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$Kd,PREG_SET_ORDER);foreach($Kd
as$B){$J[""]["columns"][]=idf_unescape($B[2]).$B[4];$J[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$J){foreach(fields($R)as$C=>$q){if($q["primary"])$J[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$Kf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$j);foreach(get_rows("PRAGMA index_list(".table($R).")",$j)as$K){$C=$K["name"];$w=array("type"=>($K["unique"]?"UNIQUE":"INDEX"));$w["lengths"]=array();$w["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$j)as$kf){$w["columns"][]=$kf["name"];$w["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$Kf[$C],$Ye)){preg_match_all('/("[^"]*+")+( DESC)?/',$Ye[2],$Kd);foreach($Kd[2]as$z=>$X){if($X)$w["descs"][$z]='1';}}if(!$J[""]||$w["type"]!="UNIQUE"||$w["columns"]!=$J[""]["columns"]||$w["descs"]!=$J[""]["descs"]||!preg_match("~^sqlite_~",$C))$J[$C]=$w;}return$J;}function
foreign_keys($R){$J=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$K){$wc=&$J[$K["id"]];if(!$wc)$wc=$K;$wc["source"][]=$K["from"];$wc["target"][]=$K["to"];}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$i->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($n){return
false;}function
error(){global$i;return
h($i->error);}function
check_sqlite_name($C){global$i;$dc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($dc)\$~",$C)){$i->error=lang(21,str_replace("|",", ",$dc));return
false;}return
true;}function
create_database($n,$e){global$i;if(file_exists($n)){$i->error=lang(22);return
false;}if(!check_sqlite_name($n))return
false;try{$A=new
Min_SQLite($n);}catch(Exception$Wb){$i->error=$Wb->getMessage();return
false;}$A->query('PRAGMA encoding = "UTF-8"');$A->query('CREATE TABLE adminer (i)');$A->query('DROP TABLE adminer');return
true;}function
drop_databases($m){global$i;$i->__construct(":memory:");foreach($m
as$n){if(!@unlink($n)){$i->error=lang(22);return
false;}}return
true;}function
rename_database($C,$e){global$i;if(!check_sqlite_name($C))return
false;$i->__construct(":memory:");$i->error=lang(22);return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){$Lg=($R==""||$tc);foreach($r
as$q){if($q[0]!=""||!$q[1]||$q[2]){$Lg=true;break;}}$c=array();$se=array();foreach($r
as$q){if($q[1]){$c[]=($Lg?$q[1]:"ADD ".implode($q[1]));if($q[0]!="")$se[$q[0]]=$q[1][0];}}if(!$Lg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$C&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($R,$C,$c,$se,$tc))return
false;if($Fa)queries("UPDATE sqlite_sequence SET seq = $Fa WHERE name = ".q($C));return
true;}function
recreate_table($R,$C,$r,$se,$tc,$x=array()){if($R!=""){if(!$r){foreach(fields($R)as$z=>$q){if($x)$q["auto_increment"]=0;$r[]=process_field($q,$q);$se[$z]=idf_escape($z);}}$Je=false;foreach($r
as$q){if($q[6])$Je=true;}$Hb=array();foreach($x
as$z=>$X){if($X[2]=="DROP"){$Hb[$X[1]]=true;unset($x[$z]);}}foreach(indexes($R)as$qd=>$w){$g=array();foreach($w["columns"]as$z=>$f){if(!$se[$f])continue
2;$g[]=$se[$f].($w["descs"][$z]?" DESC":"");}if(!$Hb[$qd]){if($w["type"]!="PRIMARY"||!$Je)$x[]=array($w["type"],$qd,$g);}}foreach($x
as$z=>$X){if($X[0]=="PRIMARY"){unset($x[$z]);$tc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$qd=>$wc){foreach($wc["source"]as$z=>$f){if(!$se[$f])continue
2;$wc["source"][$z]=idf_unescape($se[$f]);}if(!isset($tc[" $qd"]))$tc[]=" ".format_foreign_key($wc);}queries("BEGIN");}foreach($r
as$z=>$q)$r[$z]="  ".implode($q);$r=array_merge($r,array_filter($tc));if(!queries("CREATE TABLE ".table($R!=""?"adminer_$C":$C)." (\n".implode(",\n",$r)."\n)"))return
false;if($R!=""){if($se&&!queries("INSERT INTO ".table("adminer_$C")." (".implode(", ",$se).") SELECT ".implode(", ",array_map('idf_escape',array_keys($se)))." FROM ".table($R)))return
false;$yg=array();foreach(triggers($R)as$wg=>$hg){$vg=trigger($wg);$yg[]="CREATE TRIGGER ".idf_escape($wg)." ".implode(" ",$hg)." ON ".table($C)."\n$vg[Statement]";}if(!queries("DROP TABLE ".table($R)))return
false;queries("ALTER TABLE ".table("adminer_$C")." RENAME TO ".table($C));if(!alter_indexes($C,$x))return
false;foreach($yg
as$vg){if(!queries($vg))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$C,$g){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($R."_"))." ON ".table($R)." $g";}function
alter_indexes($R,$c){foreach($c
as$Ie){if($Ie[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($Sg){return
apply_queries("DROP VIEW",$Sg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$Sg,$ag){return
false;}function
trigger($C){global$i;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$v='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$xg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$v\\s*(".implode("|",$xg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($v))?\\s+ON\\s*$v\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$i->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$ee=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($ee?" OF":""),"Of"=>($ee[0]=='`'||$ee[0]=='"'?idf_unescape($ee):$ee),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($R){$J=array();$xg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$K){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$xg["Timing"]).')\s*(.*)\s+ON\b~iU',$K["sql"],$B);$J[$K["name"]]=array($B[1],$B[2]);}return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$i;return$i->result("SELECT LAST_INSERT_ROWID()");}function
explain($i,$H){return$i->query("EXPLAIN QUERY PLAN $H");}function
found_rows($S,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($nf){return
true;}function
create_sql($R,$Fa,$Rf){global$i;$J=$i->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$C=>$w){if($C=='')continue;$J.=";\n\n".index_sql($R,$w['type'],$C,"(".implode(", ",array_map('idf_escape',$w['columns'])).")");}return$J;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($l){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){global$i;$J=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$z)$J[$z]=$i->result("PRAGMA $z");return$J;}function
show_status(){$J=array();foreach(get_vals("PRAGMA compile_options")as$ne){list($z,$X)=explode("=",$ne,2);$J[$z]=$X;}return$J;}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
support($hc){return
preg_match('~^(columns|database|drop_col|dump|indexes|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$hc);}$y="sqlite";$_g=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Qf=array_keys($_g);$Gg=array();$me=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$Cc=array("hex","length","lower","round","unixepoch","upper");$Gc=array("avg","count","count distinct","group_concat","max","min","sum");$Kb=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$Fb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$Ge=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Ub,$p){if(ini_bool("html_errors"))$p=html_entity_decode(strip_tags($p));$p=preg_replace('~^[^:]*: ~','',$p);$this->error=$p;}function
connect($O,$V,$G){global$b;$n=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($G,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($n!=""?addcslashes($n,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$n!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Qg=pg_version($this->_link);$this->server_info=$Qg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($Q){return"'".pg_escape_string($this->_link,$Q)."'";}function
value($X,$q){return($q["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($Q){return"'".pg_escape_bytea($this->_link,$Q)."'";}function
select_db($l){global$b;if($l==$b->database())return$this->_database;$J=@pg_connect("$this->_string dbname='".addcslashes($l,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($J)$this->_link=$J;return$J;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($H,$Ag=false){$I=@pg_query($this->_link,$H);$this->error="";if(!$I){$this->error=pg_last_error($this->_link);$J=false;}elseif(!pg_num_fields($I)){$this->affected_rows=pg_affected_rows($I);$J=true;}else$J=new
Min_Result($I);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$J;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$q=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;return
pg_fetch_result($I->_result,0,$q);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=pg_num_rows($I);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$f=$this->_offset++;$J=new
stdClass;if(function_exists('pg_field_table'))$J->orgtable=pg_field_table($this->_result,$f);$J->name=pg_field_name($this->_result,$f);$J->orgname=$J->name;$J->type=pg_field_type($this->_result,$f);$J->charsetnr=($J->type=="bytea"?63:0);return$J;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($O,$V,$G){global$b;$n=$b->database();$Q="pgsql:host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$Q dbname='".($n!=""?addcslashes($n,"'\\"):"postgres")."'",$V,$G);return
true;}function
select_db($l){global$b;return($b->database()==$l);}function
quoteBinary($lf){return
q($lf);}function
query($H,$Ag=false){$J=parent::query($H,$Ag);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$J;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Ie){global$i;foreach($L
as$P){$Hg=array();$Z=array();foreach($P
as$z=>$X){$Hg[]="$z = $X";if(isset($Ie[idf_unescape($z)]))$Z[]="$z = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Hg)." WHERE ".implode(" AND ",$Z))&&$i->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).")")))return
false;}return
true;}function
slowQuery($H,$gg){$this->_conn->query("SET statement_timeout = ".(1000*$gg));$this->_conn->timeout=1000*$gg;return$H;}function
convertSearch($v,$X,$q){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|'.number_type():'').'~',$q["type"])?$v:"CAST($v AS text)");}function
quoteBinary($lf){return$this->_conn->quoteBinary($lf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$Cd=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$A=$Cd[$_GET["ns"]];if($A)return"$A-".str_replace("_","-",$C).".html";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b,$_g,$Qf;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2])){if(min_version(9,0,$i)){$i->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$i)){$Qf[lang(23)][]="json";$_g["json"]=4294967295;if(min_version(9.4,0,$i)){$Qf[lang(23)][]="jsonb";$_g["jsonb"]=4294967295;}}}return$i;}return$i->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($H,$Z,$_,$fe=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($fe?" OFFSET $fe":""):"");}function
limit1($R,$H,$Z,$N="\n"){return(preg_match('~^INTO~',$H)?limit($H,$Z,1,0,$N):" $H".(is_view(table_status1($R))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$N."LIMIT 1)"));}function
db_collation($n,$db){global$i;return$i->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT user");}function
tables_list(){$H="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$H.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$H.="
ORDER BY 1";return
get_key_vals($H);}function
count_tables($m){return
array();}function
table_status($C=""){$J=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", CASE WHEN c.relhasoids THEN 'oid' ELSE '' END AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$K)$J[$K["Name"]]=$K;return($C!=""?$J[$C]:$J);}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$J=array();$xa=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($R)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$K){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$K["full_type"],$B);list(,$U,$_d,$K["length"],$sa,$za)=$B;$K["length"].=$za;$Va=$U.$sa;if(isset($xa[$Va])){$K["type"]=$xa[$Va];$K["full_type"]=$K["type"].$_d.$za;}else{$K["type"]=$U;$K["full_type"]=$K["type"].$_d.$sa.$za;}$K["null"]=!$K["attnotnull"];$K["auto_increment"]=preg_match('~^nextval\(~i',$K["default"]);$K["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$K["default"],$B))$K["default"]=($B[1]=="NULL"?null:(($B[1][0]=="'"?idf_unescape($B[1]):$B[1]).$B[2]));$J[$K["field"]]=$K;}return$J;}function
indexes($R,$j=null){global$i;if(!is_object($j))$j=$i;$J=array();$Yf=$j->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($R));$g=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Yf AND attnum > 0",$j);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Yf AND ci.oid = i.indexrelid",$j)as$K){$Ze=$K["relname"];$J[$Ze]["type"]=($K["indispartial"]?"INDEX":($K["indisprimary"]?"PRIMARY":($K["indisunique"]?"UNIQUE":"INDEX")));$J[$Ze]["columns"]=array();foreach(explode(" ",$K["indkey"])as$ad)$J[$Ze]["columns"][]=$g[$ad];$J[$Ze]["descs"]=array();foreach(explode(" ",$K["indoption"])as$bd)$J[$Ze]["descs"][]=($bd&1?'1':null);$J[$Ze]["lengths"]=array();}return$J;}function
foreign_keys($R){global$he;$J=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($R)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$K){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$K['definition'],$B)){$K['source']=array_map('trim',explode(',',$B[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$Jd)){$K['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Jd[2]));$K['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Jd[4]));}$K['target']=array_map('trim',explode(',',$B[3]));$K['on_delete']=(preg_match("~ON DELETE ($he)~",$B[4],$Jd)?$Jd[1]:'NO ACTION');$K['on_update']=(preg_match("~ON UPDATE ($he)~",$B[4],$Jd)?$Jd[1]:'NO ACTION');$J[$K['conname']]=$K;}}return$J;}function
view($C){global$i;return
array("select"=>trim($i->result("SELECT view_definition
FROM information_schema.views
WHERE table_schema = current_schema() AND table_name = ".q($C))));}function
collations(){return
array();}function
information_schema($n){return($n=="information_schema");}function
error(){global$i;$J=h($i->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$J,$B))$J=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($J);}function
create_database($n,$e){return
queries("CREATE DATABASE ".idf_escape($n).($e?" ENCODING ".idf_escape($e):""));}function
drop_databases($m){global$i;$i->close();return
apply_queries("DROP DATABASE",$m,'idf_escape');}function
rename_database($C,$e){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){$c=array();$Qe=array();foreach($r
as$q){$f=idf_escape($q[0]);$X=$q[1];if(!$X)$c[]="DROP $f";else{$Ng=$X[5];unset($X[5]);if(isset($X[6])&&$q[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($q[0]=="")$c[]=($R!=""?"ADD ":"  ").implode($X);else{if($f!=$X[0])$Qe[]="ALTER TABLE ".table($R)." RENAME $f TO $X[0]";$c[]="ALTER $f TYPE$X[1]";if(!$X[6]){$c[]="ALTER $f ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $f ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($q[0]!=""||$Ng!="")$Qe[]="COMMENT ON COLUMN ".table($R).".$X[0] IS ".($Ng!=""?substr($Ng,9):"''");}}$c=array_merge($c,$tc);if($R=="")array_unshift($Qe,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Qe,"ALTER TABLE ".table($R)."\n".implode(",\n",$c));if($R!=""&&$R!=$C)$Qe[]="ALTER TABLE ".table($R)." RENAME TO ".table($C);if($R!=""||$hb!="")$Qe[]="COMMENT ON TABLE ".table($C)." IS ".q($hb);if($Fa!=""){}foreach($Qe
as$H){if(!queries($H))return
false;}return
true;}function
alter_indexes($R,$c){$ob=array();$Gb=array();$Qe=array();foreach($c
as$X){if($X[0]!="INDEX")$ob[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Gb[]=idf_escape($X[1]);else$Qe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($ob)array_unshift($Qe,"ALTER TABLE ".table($R).implode(",",$ob));if($Gb)array_unshift($Qe,"DROP INDEX ".implode(", ",$Gb));foreach($Qe
as$H){if(!queries($H))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('table',$T)));return
true;}function
drop_views($Sg){return
drop_tables($Sg);}function
drop_tables($T){foreach($T
as$R){$Of=table_status($R);if(!queries("DROP ".strtoupper($Of["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$Sg,$ag){foreach(array_merge($T,$Sg)as$R){$Of=table_status($R);if(!queries("ALTER ".strtoupper($Of["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($ag)))return
false;}return
true;}function
trigger($C,$R=null){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($R===null)$R=$_GET['trigger'];$L=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($R).' AND t.trigger_name = '.q($C));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($R))as$K)$J[$K["trigger_name"]]=array($K["action_timing"],$K["event_manipulation"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$U){$L=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$J=$L[0];$J["returns"]=array("type"=>$J["type_udt_name"]);$J["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$J;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$K){$J=array();foreach($K["fields"]as$q)$J[]=$q["type"];return
idf_escape($C)."(".implode(", ",$J).")";}function
last_id(){return
0;}function
explain($i,$H){return$i->query("EXPLAIN $H");}function
found_rows($S,$Z){global$i;if(preg_match("~ rows=([0-9]+)~",$i->result("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Ye))return$Ye[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$i;return$i->result("SELECT current_schema()");}function
set_schema($mf){global$i,$_g,$Qf;$J=$i->query("SET search_path TO ".idf_escape($mf));foreach(types()as$U){if(!isset($_g[$U])){$_g[$U]=0;$Qf[lang(24)][]=$U;}}return$J;}function
create_sql($R,$Fa,$Rf){global$i;$J='';$if=array();$wf=array();$Of=table_status($R);$r=fields($R);$x=indexes($R);ksort($x);$qc=foreign_keys($R);ksort($qc);if(!$Of||empty($r))return
false;$J="CREATE TABLE ".idf_escape($Of['nspname']).".".idf_escape($Of['Name'])." (\n    ";foreach($r
as$ic=>$q){$ye=idf_escape($q['field']).' '.$q['full_type'].default_value($q).($q['attnotnull']?" NOT NULL":"");$if[]=$ye;if(preg_match('~nextval\(\'([^\']+)\'\)~',$q['default'],$Kd)){$vf=$Kd[1];$If=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($vf):"SELECT * FROM $vf"));$wf[]=($Rf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $vf;\n":"")."CREATE SEQUENCE $vf INCREMENT $If[increment_by] MINVALUE $If[min_value] MAXVALUE $If[max_value] START ".($Fa?$If['last_value']:1)." CACHE $If[cache_value];";}}if(!empty($wf))$J=implode("\n\n",$wf)."\n\n$J";foreach($x
as$Vc=>$w){switch($w['type']){case'UNIQUE':$if[]="CONSTRAINT ".idf_escape($Vc)." UNIQUE (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;case'PRIMARY':$if[]="CONSTRAINT ".idf_escape($Vc)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;}}foreach($qc
as$pc=>$oc)$if[]="CONSTRAINT ".idf_escape($pc)." $oc[definition] ".($oc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$J.=implode(",\n    ",$if)."\n) WITH (oids = ".($Of['Oid']?'true':'false').");";foreach($x
as$Vc=>$w){if($w['type']=='INDEX')$J.="\n\nCREATE INDEX ".idf_escape($Vc)." ON ".idf_escape($Of['nspname']).".".idf_escape($Of['Name'])." USING btree (".implode(', ',array_map('idf_escape',$w['columns'])).");";}if($Of['Comment'])$J.="\n\nCOMMENT ON TABLE ".idf_escape($Of['nspname']).".".idf_escape($Of['Name'])." IS ".q($Of['Comment']).";";foreach($r
as$ic=>$q){if($q['comment'])$J.="\n\nCOMMENT ON COLUMN ".idf_escape($Of['nspname']).".".idf_escape($Of['Name']).".".idf_escape($ic)." IS ".q($q['comment']).";";}return
rtrim($J,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$Of=table_status($R);$J="";foreach(triggers($R)as$ug=>$tg){$vg=trigger($ug,$Of['Name']);$J.="\nCREATE TRIGGER ".idf_escape($vg['Trigger'])." $vg[Timing] $vg[Events] ON ".idf_escape($Of["nspname"]).".".idf_escape($Of['Name'])." $vg[Type] $vg[Statement];;\n";}return$J;}function
use_sql($l){return"\connect ".idf_escape($l);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
support($hc){return
preg_match('~^(database|table|columns|sql|indexes|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$hc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$i;return$i->result("SHOW max_connections");}$y="pgsql";$_g=array();$Qf=array();foreach(array(lang(25)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(26)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(23)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(27)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(28)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),lang(29)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$z=>$X){$_g+=$X;$Qf[$z]=array_keys($X);}$Gg=array();$me=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Cc=array("char_length","lower","round","to_hex","to_timestamp","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Kb=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$Fb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$Ge=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($Ub,$p){if(ini_bool("html_errors"))$p=html_entity_decode(strip_tags($p));$p=preg_replace('~^[^:]*: ~','',$p);$this->error=$p;}function
connect($O,$V,$G){$this->_link=@oci_new_connect($V,$G,$O,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$p=oci_error();$this->error=$p["message"];return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($l){return
true;}function
query($H,$Ag=false){$I=oci_parse($this->_link,$H);$this->error="";if(!$I){$p=oci_error($this->_link);$this->errno=$p["code"];$this->error=$p["message"];return
false;}set_error_handler(array($this,'_error'));$J=@oci_execute($I);restore_error_handler();if($J){if(oci_num_fields($I))return
new
Min_Result($I);$this->affected_rows=oci_num_rows($I);}return$J;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$q=1){$I=$this->query($H);if(!is_object($I)||!oci_fetch($I->_result))return
false;return
oci_result($I->_result,$q);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$z=>$X){if(is_a($X,'OCI-Lob'))$K[$z]=$X->load();}return$K;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$f=$this->_offset++;$J=new
stdClass;$J->name=oci_field_name($this->_result,$f);$J->orgname=$J->name;$J->type=oci_field_type($this->_result,$f);$J->charsetnr=(preg_match("~raw|blob|bfile~",$J->type)?63:0);return$J;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($O,$V,$G){$this->dsn("oci:dbname=//$O;charset=AL32UTF8",$V,$G);return
true;}function
select_db($l){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2]))return$i;return$i->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($H,$Z,$_,$fe=0,$N=" "){return($fe?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $H$Z) t WHERE rownum <= ".($_+$fe).") WHERE rnum > $fe":($_!==null?" * FROM (SELECT $H$Z) WHERE rownum <= ".($_+$fe):" $H$Z"));}function
limit1($R,$H,$Z,$N="\n"){return" $H$Z";}function
db_collation($n,$db){global$i;return$i->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($m){return
array();}function
table_status($C=""){$J=array();$of=q($C);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($C!=""?" AND table_name = $of":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($C!=""?" WHERE view_name = $of":"")."
ORDER BY 1")as$K){if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$J=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)." ORDER BY column_id")as$K){$U=$K["DATA_TYPE"];$_d="$K[DATA_PRECISION],$K[DATA_SCALE]";if($_d==",")$_d=$K["DATA_LENGTH"];$J[$K["COLUMN_NAME"]]=array("field"=>$K["COLUMN_NAME"],"full_type"=>$U.($_d?"($_d)":""),"type"=>strtolower($U),"length"=>$_d,"default"=>$K["DATA_DEFAULT"],"null"=>($K["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($R)."
ORDER BY uc.constraint_type, uic.column_position",$j)as$K){$Vc=$K["INDEX_NAME"];$J[$Vc]["type"]=($K["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($K["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$J[$Vc]["columns"][]=$K["COLUMN_NAME"];$J[$Vc]["lengths"][]=($K["CHAR_LENGTH"]&&$K["CHAR_LENGTH"]!=$K["COLUMN_LENGTH"]?$K["CHAR_LENGTH"]:null);$J[$Vc]["descs"][]=($K["DESCEND"]?'1':null);}return$J;}function
view($C){$L=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($C));return
reset($L);}function
collations(){return
array();}function
information_schema($n){return
false;}function
error(){global$i;return
h($i->error);}function
explain($i,$H){$i->query("EXPLAIN PLAN FOR $H");return$i->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){$c=$Gb=array();foreach($r
as$q){$X=$q[1];if($X&&$q[0]!=""&&idf_escape($q[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($q[0])." TO $X[0]");if($X)$c[]=($R!=""?($q[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$Gb[]=idf_escape($q[0]);}if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($R)."\n".implode("\n",$c)))&&(!$Gb||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$Gb).")"))&&($R==$C||queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)));}function
foreign_keys($R){$J=array();$H="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($H)as$K)$J[$K['NAME']]=array("db"=>$K['DEST_DB'],"table"=>$K['DEST_TABLE'],"source"=>array($K['SRC_COLUMN']),"target"=>array($K['DEST_COLUMN']),"on_delete"=>$K['ON_DELETE'],"on_update"=>null,);return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Sg){return
apply_queries("DROP VIEW",$Sg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$i;return$i->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($nf){global$i;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($nf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$L=get_rows('SELECT * FROM v$instance');return
reset($L);}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
support($hc){return
preg_match('~^(columns|database|drop_col|indexes|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$hc);}$y="oracle";$_g=array();$Qf=array();foreach(array(lang(25)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(26)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(23)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(27)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$z=>$X){$_g+=$X;$Qf[$z]=array_keys($X);}$Gg=array();$me=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Cc=array("length","lower","round","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Kb=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$Fb["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$Ge=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$p){$this->errno=$p["code"];$this->error.="$p[message]\n";}$this->error=rtrim($this->error);}function
connect($O,$V,$G){$xf=explode(':',$O,2);if(count($xf)==2)$yf=implode(', ',$xf);else$yf=$O;$this->_link=@sqlsrv_connect($yf,array("UID"=>$V,"PWD"=>$G,"CharacterSet"=>"UTF-8"));if($this->_link){$cd=sqlsrv_server_info($this->_link);$this->server_info=$cd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($l){return$this->query("USE ".idf_escape($l));}function
query($H,$Ag=false){$I=sqlsrv_query($this->_link,$H);$this->error="";if(!$I){$this->_get_error();return
false;}return$this->store_result($I);}function
multi_query($H){$this->_result=sqlsrv_query($this->_link,$H);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($I=null){if(!$I)$I=$this->_result;if(!$I)return
false;if(sqlsrv_field_metadata($I))return
new
Min_Result($I);$this->affected_rows=sqlsrv_rows_affected($I);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($H,$q=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->fetch_row();return$K[$q];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$z=>$X){if(is_a($X,'DateTime'))$K[$z]=$X->format("Y-m-d H:i:s");}return$K;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$q=$this->_fields[$this->_offset++];$J=new
stdClass;$J->name=$q["Name"];$J->orgname=$q["Name"];$J->type=($q["Type"]==1?254:0);return$J;}function
seek($fe){for($t=0;$t<$fe;$t++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($O,$V,$G){$this->_link=@mssql_connect($O,$V,$G);if($this->_link){$I=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");$K=$I->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$K[0]] $K[1]";}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($l){return
mssql_select_db($l);}function
query($H,$Ag=false){$I=@mssql_query($H,$this->_link);$this->error="";if(!$I){$this->error=mssql_get_last_message();return
false;}if($I===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($H,$q=0){$I=$this->query($H);if(!is_object($I))return
false;return
mssql_result($I->_result,0,$q);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=mssql_num_rows($I);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$J=mssql_fetch_field($this->_result);$J->orgtable=$J->table;$J->orgname=$J->name;return$J;}function
seek($fe){mssql_data_seek($this->_result,$fe);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($O,$V,$G){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$G);return
true;}function
select_db($l){return$this->query("USE ".idf_escape($l));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Ie){foreach($L
as$P){$Hg=array();$Z=array();foreach($P
as$z=>$X){$Hg[]="$z = $X";if(isset($Ie[idf_unescape($z)]))$Z[]="$z = $X";}if(!queries("MERGE ".table($R)." USING (VALUES(".implode(", ",$P).")) AS source (c".implode(", c",range(1,count($P))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Hg)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($v){return"[".str_replace("]","]]",$v)."]";}function
table($v){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2]))return$i;return$i->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($H,$Z,$_,$fe=0,$N=" "){return($_!==null?" TOP (".($_+$fe).")":"")." $H$Z";}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($n,$db){global$i;return$i->result("SELECT collation_name FROM sys.databases WHERE name = ".q($n));}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($m){global$i;$J=array();foreach($m
as$n){$i->select_db($n);$J[$n]=$i->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$J;}function
table_status($C=""){$J=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$K){if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$J=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($R))as$K){$U=$K["type"];$_d=(preg_match("~char|binary~",$U)?$K["max_length"]:($U=="decimal"?"$K[precision],$K[scale]":""));$J[$K["name"]]=array("field"=>$K["name"],"full_type"=>$U.($_d?"($_d)":""),"type"=>$U,"length"=>$_d,"default"=>$K["default"],"null"=>$K["is_nullable"],"auto_increment"=>$K["is_identity"],"collation"=>$K["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$K["is_identity"],);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$j)as$K){$C=$K["name"];$J[$C]["type"]=($K["is_primary_key"]?"PRIMARY":($K["is_unique"]?"UNIQUE":"INDEX"));$J[$C]["lengths"]=array();$J[$C]["columns"][$K["key_ordinal"]]=$K["column_name"];$J[$C]["descs"][$K["key_ordinal"]]=($K["is_descending_key"]?'1':null);}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$i->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$J=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$e)$J[preg_replace('~_.*~','',$e)][]=$e;return$J;}function
information_schema($n){return
false;}function
error(){global$i;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$i->error)));}function
create_database($n,$e){return
queries("CREATE DATABASE ".idf_escape($n).(preg_match('~^[a-z0-9_]+$~i',$e)?" COLLATE $e":""));}function
drop_databases($m){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$m)));}function
rename_database($C,$e){if(preg_match('~^[a-z0-9_]+$~i',$e))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $e");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){$c=array();foreach($r
as$q){$f=idf_escape($q[0]);$X=$q[1];if(!$X)$c["DROP"][]=" COLUMN $f";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);if($q[0]=="")$c["ADD"][]="\n  ".implode("",$X).($R==""?substr($tc[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($f!=$X[0])queries("EXEC sp_rename ".q(table($R).".$f").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($R=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($R!=$C)queries("EXEC sp_rename ".q(table($R)).", ".q($C));if($tc)$c[""]=$tc;foreach($c
as$z=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $z".implode(",",$X)))return
false;}return
true;}function
alter_indexes($R,$c){$w=array();$Gb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Gb[]=idf_escape($X[1]);else$w[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$w||queries("DROP INDEX ".implode(", ",$w)))&&(!$Gb||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$Gb)));}function
last_id(){global$i;return$i->result("SELECT SCOPE_IDENTITY()");}function
explain($i,$H){$i->query("SET SHOWPLAN_ALL ON");$J=$i->query($H);$i->query("SET SHOWPLAN_ALL OFF");return$J;}function
found_rows($S,$Z){}function
foreign_keys($R){$J=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R))as$K){$wc=&$J[$K["FK_NAME"]];$wc["table"]=$K["PKTABLE_NAME"];$wc["source"][]=$K["FKCOLUMN_NAME"];$wc["target"][]=$K["PKCOLUMN_NAME"];}return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Sg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Sg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Sg,$ag){return
apply_queries("ALTER SCHEMA ".idf_escape($ag)." TRANSFER",array_merge($T,$Sg));}function
trigger($C){if($C=="")return
array();$L=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$J=reset($L);if($J)$J["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$J["text"]);return$J;}function
triggers($R){$J=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$K)$J[$K["name"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$i;if($_GET["ns"]!="")return$_GET["ns"];return$i->result("SELECT SCHEMA_NAME()");}function
set_schema($mf){return
true;}function
use_sql($l){return"USE ".idf_escape($l);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
support($hc){return
preg_match('~^(columns|database|drop_col|indexes|scheme|sql|table|trigger|view|view_trigger)$~',$hc);}$y="mssql";$_g=array();$Qf=array();foreach(array(lang(25)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(26)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(23)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(27)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$z=>$X){$_g+=$X;$Qf[$z]=array_keys($X);}$Gg=array();$me=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Cc=array("len","lower","round","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Kb=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$Fb['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$Ge=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$G){$this->_link=ibase_connect($O,$V,$G);if($this->_link){$Kg=explode(':',$O);$this->service_link=ibase_service_attach($Kg[0],$V,$G);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($l){return($l=="domain");}function
query($H,$Ag=false){$I=ibase_query($H,$this->_link);if(!$I){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($I===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$q=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;$K=$I->fetch_row();return$K[$q];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$q=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$q['name'],'orgname'=>$q['name'],'type'=>$q['type'],'charsetnr'=>$q['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2]))return$i;return$i->error;}function
get_databases($rc){return
array("domain");}function
limit($H,$Z,$_,$fe=0,$N=" "){$J='';$J.=($_!==null?$N."FIRST $_".($fe?" SKIP $fe":""):"");$J.=" $H$Z";return$J;}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($n,$db){}function
engines(){return
array();}function
logged_user(){global$b;$k=$b->credentials();return$k[1];}function
tables_list(){global$i;$H='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$I=ibase_query($i->_link,$H);$J=array();while($K=ibase_fetch_assoc($I))$J[$K['RDB$RELATION_NAME']]='table';ksort($J);return$J;}function
count_tables($m){return
array();}function
table_status($C="",$gc=false){global$i;$J=array();$tb=tables_list();foreach($tb
as$w=>$X){$w=trim($w);$J[$w]=array('Name'=>$w,'Engine'=>'standard',);if($C==$w)return$J[$w];}return$J;}function
is_view($S){return
false;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"]);}function
fields($R){global$i;$J=array();$H='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($R).'
ORDER BY r.RDB$FIELD_POSITION';$I=ibase_query($i->_link,$H);while($K=ibase_fetch_assoc($I))$J[trim($K['FIELD_NAME'])]=array("field"=>trim($K["FIELD_NAME"]),"full_type"=>trim($K["FIELD_TYPE"]),"type"=>trim($K["FIELD_SUB_TYPE"]),"default"=>trim($K['FIELD_DEFAULT_VALUE']),"null"=>(trim($K["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($K["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($K["FIELD_DESCRIPTION"]),);return$J;}function
indexes($R,$j=null){$J=array();return$J;}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($n){return
false;}function
error(){global$i;return
h($i->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($mf){return
true;}function
support($hc){return
preg_match("~^(columns|sql|status|table)$~",$hc);}$y="firebird";$me=array("=");$Cc=array();$Gc=array();$Kb=array();}$Fb["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$Ge=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($l){return($l=="domain");}function
query($H,$Ag=false){$F=array('SelectExpression'=>$H,'ConsistentRead'=>'true');if($this->next)$F['NextToken']=$this->next;$I=sdb_request_all('Select','Item',$F,$this->timeout);$this->timeout=0;if($I===false)return$I;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$H)){$Uf=0;foreach($I
as$md)$Uf+=$md->Attribute->Value;$I=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Uf,))));}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($I){foreach($I
as$md){$K=array();if($md->Name!='')$K['itemName()']=(string)$md->Name;foreach($md->Attribute
as$Ca){$C=$this->_processValue($Ca->Name);$Y=$this->_processValue($Ca->Value);if(isset($K[$C])){$K[$C]=(array)$K[$C];$K[$C][]=$Y;}else$K[$C]=$Y;}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($Mb){return(is_object($Mb)&&$Mb['encoding']=='base64'?base64_decode($Mb):(string)$Mb);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$rd=array_keys($this->_rows[0]);return(object)array('name'=>$rd[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$Ie="itemName()";function
_chunkRequest($Tc,$ra,$F,$Zb=array()){global$i;foreach(array_chunk($Tc,25)as$Ya){$xe=$F;foreach($Ya
as$t=>$u){$xe["Item.$t.ItemName"]=$u;foreach($Zb
as$z=>$X)$xe["Item.$t.$z"]=$X;}if(!sdb_request($ra,$xe))return
false;}$i->affected_rows=count($Tc);return
true;}function
_extractIds($R,$Re,$_){$J=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$Re,$Kd))$J=array_map('idf_unescape',$Kd[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($R).$Re.($_?" LIMIT 1":"")))as$md)$J[]=$md->Name;}return$J;}function
select($R,$M,$Z,$Dc,$pe=array(),$_=1,$E=0,$Ke=false){global$i;$i->next=$_GET["next"];$J=parent::select($R,$M,$Z,$Dc,$pe,$_,$E,$Ke);$i->next=0;return$J;}function
delete($R,$Re,$_=0){return$this->_chunkRequest($this->_extractIds($R,$Re,$_),'BatchDeleteAttributes',array('DomainName'=>$R));}function
update($R,$P,$Re,$_=0,$N="\n"){$yb=array();$gd=array();$t=0;$Tc=$this->_extractIds($R,$Re,$_);$u=idf_unescape($P["`itemName()`"]);unset($P["`itemName()`"]);foreach($P
as$z=>$X){$z=idf_unescape($z);if($X=="NULL"||($u!=""&&array($u)!=$Tc))$yb["Attribute.".count($yb).".Name"]=$z;if($X!="NULL"){foreach((array)$X
as$nd=>$W){$gd["Attribute.$t.Name"]=$z;$gd["Attribute.$t.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$nd)$gd["Attribute.$t.Replace"]="true";$t++;}}}$F=array('DomainName'=>$R);return(!$gd||$this->_chunkRequest(($u!=""?array($u):$Tc),'BatchPutAttributes',$F,$gd))&&(!$yb||$this->_chunkRequest($Tc,'BatchDeleteAttributes',$F,$yb));}function
insert($R,$P){$F=array("DomainName"=>$R);$t=0;foreach($P
as$C=>$Y){if($Y!="NULL"){$C=idf_unescape($C);if($C=="itemName()")$F["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$F["Attribute.$t.Name"]=$C;$F["Attribute.$t.Value"]=(is_array($Y)?$X:idf_unescape($Y));$t++;}}}}return
sdb_request('PutAttributes',$F);}function
insertUpdate($R,$L,$Ie){foreach($L
as$P){if(!$this->update($R,$P,"WHERE `itemName()` = ".q($P["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($H,$gg){$this->_conn->timeout=$gg;return$H;}}function
connect(){return
new
Min_DB;}function
support($hc){return
preg_match('~sql~',$hc);}function
logged_user(){global$b;$k=$b->credentials();return$k[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($n,$db){}function
tables_list(){global$i;$J=array();foreach(sdb_request_all('ListDomains','DomainName')as$R)$J[(string)$R]='table';if($i->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$J;}function
table_status($C="",$gc=false){$J=array();foreach(($C!=""?array($C=>true):tables_list())as$R=>$U){$K=array("Name"=>$R,"Auto_increment"=>"");if(!$gc){$Sd=sdb_request('DomainMetadata',array('DomainName'=>$R));if($Sd){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$z=>$X)$K[$z]=(string)$Sd->$X;}}if($C!="")return$K;$J[$R]=$K;}return$J;}function
explain($i,$H){}function
error(){global$i;return
h($i->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$j=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($R){return
fields_from_edit();}function
foreign_keys($R){return
array();}function
table($v){return
idf_escape($v);}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
limit($H,$Z,$_,$fe=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_":"");}function
unconvert_field($q,$J){return$J;}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){return($R==""&&sdb_request('CreateDomain',array('DomainName'=>$C)));}function
drop_tables($T){foreach($T
as$R){if(!sdb_request('DeleteDomain',array('DomainName'=>$R)))return
false;}return
true;}function
count_tables($m){foreach($m
as$n)return
array($n=>count(tables_list()));}function
found_rows($S,$Z){return($Z?null:$S["Rows"]);}function
last_id(){}function
hmac($wa,$tb,$z,$Ve=false){$Oa=64;if(strlen($z)>$Oa)$z=pack("H*",$wa($z));$z=str_pad($z,$Oa,"\0");$od=$z^str_repeat("\x36",$Oa);$pd=$z^str_repeat("\x5C",$Oa);$J=$wa($pd.pack("H*",$wa($od.$tb)));if($Ve)$J=pack("H*",$J);return$J;}function
sdb_request($ra,$F=array()){global$b,$i;list($Qc,$F['AWSAccessKeyId'],$pf)=$b->credentials();$F['Action']=$ra;$F['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$F['Version']='2009-04-15';$F['SignatureVersion']=2;$F['SignatureMethod']='HmacSHA1';ksort($F);$H='';foreach($F
as$z=>$X)$H.='&'.rawurlencode($z).'='.rawurlencode($X);$H=str_replace('%7E','~',substr($H,1));$H.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Qc)."\n/\n$H",$pf,true)));@ini_set('track_errors',1);$kc=@file_get_contents((preg_match('~^https?://~',$Qc)?$Qc:"http://$Qc"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$H,'ignore_errors'=>1,))));if(!$kc){$i->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$dh=simplexml_load_string($kc);if(!$dh){$p=libxml_get_last_error();$i->error=$p->message;return
false;}if($dh->Errors){$p=$dh->Errors->Error;$i->error="$p->Message ($p->Code)";return
false;}$i->error='';$Zf=$ra."Result";return($dh->$Zf?$dh->$Zf:true);}function
sdb_request_all($ra,$Zf,$F=array(),$gg=0){$J=array();$Mf=($gg?microtime(true):0);$_=(preg_match('~LIMIT\s+(\d+)\s*$~i',$F['SelectExpression'],$B)?$B[1]:0);do{$dh=sdb_request($ra,$F);if(!$dh)break;foreach($dh->$Zf
as$Mb)$J[]=$Mb;if($_&&count($J)>=$_){$_GET["next"]=$dh->NextToken;break;}if($gg&&microtime(true)-$Mf>$gg)return
false;$F['NextToken']=$dh->NextToken;if($_)$F['SelectExpression']=preg_replace('~\d+\s*$~',$_-count($J),$F['SelectExpression']);}while($dh->NextToken);return$J;}$y="simpledb";$me=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$Cc=array();$Gc=array("count");$Kb=array(array("json"));}$Fb["mongo"]="MongoDB";if(isset($_GET["mongo"])){$Ge=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$error,$last_id,$_link,$_db;function
connect($O,$V,$G){global$b;$n=$b->database();$D=array();if($V!=""){$D["username"]=$V;$D["password"]=$G;}if($n!="")$D["db"]=$n;try{$this->_link=@new
MongoClient("mongodb://$O",$D);return
true;}catch(Exception$Wb){$this->error=$Wb->getMessage();return
false;}}function
query($H){return
false;}function
select_db($l){try{$this->_db=$this->_link->selectDB($l);return
true;}catch(Exception$Wb){$this->error=$Wb->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$md){$K=array();foreach($md
as$z=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$z]=63;$K[$z]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$rd=array_keys($this->_rows[0]);$C=$rd[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$Ie="_id";function
select($R,$M,$Z,$Dc,$pe=array(),$_=1,$E=0,$Ke=false){$M=($M==array("*")?array():array_fill_keys($M,true));$Ff=array();foreach($pe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$nb);$Ff[$X]=($nb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($R)->find(array(),$M)->sort($Ff)->limit($_!=""?+$_:0)->skip($E*$_));}function
insert($R,$P){try{$J=$this->_conn->_db->selectCollection($R)->insert($P);$this->_conn->errno=$J['code'];$this->_conn->error=$J['err'];$this->_conn->last_id=$P['_id'];return!$J['err'];}catch(Exception$Wb){$this->_conn->error=$Wb->getMessage();return
false;}}}function
get_databases($rc){global$i;$J=array();$vb=$i->_link->listDBs();foreach($vb['databases']as$n)$J[]=$n['name'];return$J;}function
count_tables($m){global$i;$J=array();foreach($m
as$n)$J[$n]=count($i->_link->selectDB($n)->getCollectionNames(true));return$J;}function
tables_list(){global$i;return
array_fill_keys($i->_db->getCollectionNames(true),'table');}function
create_database($n,$e){return
true;}function
drop_databases($m){global$i;foreach($m
as$n){$ef=$i->_link->selectDB($n)->drop();if(!$ef['ok'])return
false;}return
true;}function
indexes($R,$j=null){global$i;$J=array();foreach($i->_db->selectCollection($R)->getIndexInfo()as$w){$Ab=array();foreach($w["key"]as$f=>$U)$Ab[]=($U==-1?'1':null);$J[$w["name"]]=array("type"=>($w["name"]=="_id_"?"PRIMARY":($w["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($w["key"]),"lengths"=>array(),"descs"=>$Ab,);}return$J;}function
fields($R){return
fields_from_edit();}function
found_rows($S,$Z){global$i;return$i->_db->selectCollection($_GET["select"])->count($Z);}$me=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$error,$last_id;var$_link;var$_db,$_db_name;function
connect($O,$V,$G){global$b;$n=$b->database();$D=array();if($V!=""){$D["username"]=$V;$D["password"]=$G;}if($n!="")$D["db"]=$n;try{$d='MongoDB\Driver\Manager';$this->_link=new$d("mongodb://$O",$D);return
true;}catch(Exception$Wb){$this->error=$Wb->getMessage();return
false;}}function
query($H){return
false;}function
select_db($l){try{$this->_db_name=$l;return
true;}catch(Exception$Wb){$this->error=$Wb->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$md){$K=array();foreach($md
as$z=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$z]=63;$K[$z]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=$I->count;}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$rd=array_keys($this->_rows[0]);$C=$rd[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$Ie="_id";function
select($R,$M,$Z,$Dc,$pe=array(),$_=1,$E=0,$Ke=false){global$i;$M=($M==array("*")?array():array_fill_keys($M,1));if(count($M)&&!isset($M['_id']))$M['_id']=0;$Z=where_to_query($Z);$Ff=array();foreach($pe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$nb);$Ff[$X]=($nb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$_=$_GET['limit'];$_=min(200,max(1,(int)$_));$Cf=$E*$_;$d='MongoDB\Driver\Query';$H=new$d($Z,array('projection'=>$M,'limit'=>$_,'skip'=>$Cf,'sort'=>$Ff));$hf=$i->_link->executeQuery("$i->_db_name.$R",$H);return
new
Min_Result($hf);}function
update($R,$P,$Re,$_=0,$N="\n"){global$i;$n=$i->_db_name;$Z=sql_query_where_parser($Re);$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());if(isset($P['_id']))unset($P['_id']);$af=array();foreach($P
as$z=>$Y){if($Y=='NULL'){$af[$z]=1;unset($P[$z]);}}$Hg=array('$set'=>$P);if(count($af))$Hg['$unset']=$af;$Sa->update($Z,$Hg,array('upsert'=>false));$hf=$i->_link->executeBulkWrite("$n.$R",$Sa);$i->affected_rows=$hf->getModifiedCount();return
true;}function
delete($R,$Re,$_=0){global$i;$n=$i->_db_name;$Z=sql_query_where_parser($Re);$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());$Sa->delete($Z,array('limit'=>$_));$hf=$i->_link->executeBulkWrite("$n.$R",$Sa);$i->affected_rows=$hf->getDeletedCount();return
true;}function
insert($R,$P){global$i;$n=$i->_db_name;$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());if(isset($P['_id'])&&empty($P['_id']))unset($P['_id']);$Sa->insert($P);$hf=$i->_link->executeBulkWrite("$n.$R",$Sa);$i->affected_rows=$hf->getInsertedCount();return
true;}}function
get_databases($rc){global$i;$J=array();$d='MongoDB\Driver\Command';$gb=new$d(array('listDatabases'=>1));$hf=$i->_link->executeCommand('admin',$gb);foreach($hf
as$vb){foreach($vb->databases
as$n)$J[]=$n->name;}return$J;}function
count_tables($m){$J=array();return$J;}function
tables_list(){global$i;$d='MongoDB\Driver\Command';$gb=new$d(array('listCollections'=>1));$hf=$i->_link->executeCommand($i->_db_name,$gb);$eb=array();foreach($hf
as$I)$eb[$I->name]='table';return$eb;}function
create_database($n,$e){return
true;}function
drop_databases($m){return
false;}function
indexes($R,$j=null){global$i;$J=array();$d='MongoDB\Driver\Command';$gb=new$d(array('listIndexes'=>$R));$hf=$i->_link->executeCommand($i->_db_name,$gb);foreach($hf
as$w){$Ab=array();$g=array();foreach(get_object_vars($w->key)as$f=>$U){$Ab[]=($U==-1?'1':null);$g[]=$f;}$J[$w->name]=array("type"=>($w->name=="_id_"?"PRIMARY":(isset($w->unique)?"UNIQUE":"INDEX")),"columns"=>$g,"lengths"=>array(),"descs"=>$Ab,);}return$J;}function
fields($R){$r=fields_from_edit();if(!count($r)){global$o;$I=$o->select($R,array("*"),null,null,array(),10);while($K=$I->fetch_assoc()){foreach($K
as$z=>$X){$K[$z]=null;$r[$z]=array("field"=>$z,"type"=>"string","null"=>($z!=$o->primary),"auto_increment"=>($z==$o->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$r;}function
found_rows($S,$Z){global$i;$Z=where_to_query($Z);$d='MongoDB\Driver\Command';$gb=new$d(array('count'=>$S['Name'],'query'=>$Z));$hf=$i->_link->executeCommand($i->_db_name,$gb);$ng=$hf->toArray();return$ng[0]->n;}function
sql_query_where_parser($Re){$Re=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$Re));$Re=preg_replace('/\)\)\)$/',')',$Re);$ah=explode(' AND ',$Re);$bh=explode(') OR (',$Re);$Z=array();foreach($ah
as$Yg)$Z[]=trim($Yg);if(count($bh)==1)$bh=array();elseif(count($bh)>1)$Z=array();return
where_to_query($Z,$bh);}function
where_to_query($Wg=array(),$Xg=array()){global$b;$tb=array();foreach(array('and'=>$Wg,'or'=>$Xg)as$U=>$Z){if(is_array($Z)){foreach($Z
as$ac){list($cb,$ke,$X)=explode(" ",$ac,3);if($cb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$d='MongoDB\BSON\ObjectID';$X=new$d($X);}if(!in_array($ke,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$ke,$B)){$X=(float)$X;$ke=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$ke,$B)){$ub=new
DateTime($X);$d='MongoDB\BSON\UTCDatetime';$X=new$d($ub->getTimestamp()*1000);$ke=$B[1];}switch($ke){case'=':$ke='$eq';break;case'!=':$ke='$ne';break;case'>':$ke='$gt';break;case'<':$ke='$lt';break;case'>=':$ke='$gte';break;case'<=':$ke='$lte';break;case'regex':$ke='$regex';break;default:continue;}if($U=='and')$tb['$and'][]=array($cb=>array($ke=>$X));elseif($U=='or')$tb['$or'][]=array($cb=>array($ke=>$X));}}}return$tb;}$me=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($v){return$v;}function
idf_escape($v){return$v;}function
table_status($C="",$gc=false){$J=array();foreach(tables_list()as$R=>$U){$J[$R]=array("Name"=>$R);if($C==$R)return$J[$R];}return$J;}function
last_id(){global$i;return$i->last_id;}function
error(){global$i;return
h($i->error);}function
collations(){return
array();}function
logged_user(){global$b;$k=$b->credentials();return$k[1];}function
connect(){global$b;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2]))return$i;return$i->error;}function
alter_indexes($R,$c){global$i;foreach($c
as$X){list($U,$C,$P)=$X;if($P=="DROP")$J=$i->_db->command(array("deleteIndexes"=>$R,"index"=>$C));else{$g=array();foreach($P
as$f){$f=preg_replace('~ DESC$~','',$f,1,$nb);$g[$f]=($nb?-1:1);}$J=$i->_db->selectCollection($R)->ensureIndex($g,array("unique"=>($U=="UNIQUE"),"name"=>$C,));}if($J['errmsg']){$i->error=$J['errmsg'];return
false;}}return
true;}function
support($hc){return
preg_match("~database|indexes~",$hc);}function
db_collation($n,$db){}function
information_schema(){}function
is_view($S){}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
foreign_keys($R){return
array();}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){global$i;if($R==""){$i->_db->createCollection($C);return
true;}}function
drop_tables($T){global$i;foreach($T
as$R){$ef=$i->_db->selectCollection($R)->drop();if(!$ef['ok'])return
false;}return
true;}function
truncate_tables($T){global$i;foreach($T
as$R){$ef=$i->_db->selectCollection($R)->remove();if(!$ef['ok'])return
false;}return
true;}$y="mongo";$Cc=array();$Gc=array();$Kb=array(array("json"));}$Fb["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$Ge=array("json");define("DRIVER","elastic");if(function_exists('json_decode')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($Ae,$lb=array(),$Td='GET'){@ini_set('track_errors',1);$kc=@file_get_contents("$this->_url/".ltrim($Ae,'/'),false,stream_context_create(array('http'=>array('method'=>$Td,'content'=>$lb===null?$lb:json_encode($lb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$kc){$this->error=$php_errormsg;return$kc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$kc;return
false;}$J=json_decode($kc,true);if($J===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$kb=get_defined_constants(true);foreach($kb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return$J;}function
query($Ae,$lb=array(),$Td='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Ae,'/'),$lb,$Td);}function
connect($O,$V,$G){preg_match('~^(https?://)?(.*)~',$O,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$G@$B[2]";$J=$this->query('');if($J)$this->server_info=$J['version']['number'];return(bool)$J;}function
select_db($l){$this->_db=$l;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows;function
__construct($L){$this->num_rows=count($this->_rows);$this->_rows=$L;reset($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);next($this->_rows);return$J;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($R,$M,$Z,$Dc,$pe=array(),$_=1,$E=0,$Ke=false){global$b;$tb=array();$H="$R/_search";if($M!=array("*"))$tb["fields"]=$M;if($pe){$Ff=array();foreach($pe
as$cb){$cb=preg_replace('~ DESC$~','',$cb,1,$nb);$Ff[]=($nb?array($cb=>"desc"):$cb);}$tb["sort"]=$Ff;}if($_){$tb["size"]=+$_;if($E)$tb["from"]=($E*$_);}foreach($Z
as$X){list($cb,$ke,$X)=explode(" ",$X,3);if($cb=="_id")$tb["query"]["ids"]["values"][]=$X;elseif($cb.$X!=""){$bg=array("term"=>array(($cb!=""?$cb:"_all")=>$X));if($ke=="=")$tb["query"]["filtered"]["filter"]["and"][]=$bg;else$tb["query"]["filtered"]["query"]["bool"]["must"][]=$bg;}}if($tb["query"]&&!$tb["query"]["filtered"]["query"]&&!$tb["query"]["ids"])$tb["query"]["filtered"]["query"]=array("match_all"=>array());$Mf=microtime(true);$of=$this->_conn->query($H,$tb);if($Ke)echo$b->selectQuery("$H: ".print_r($tb,true),$Mf,!$of);if(!$of)return
false;$J=array();foreach($of['hits']['hits']as$Pc){$K=array();if($M==array("*"))$K["_id"]=$Pc["_id"];$r=$Pc['_source'];if($M!=array("*")){$r=array();foreach($M
as$z)$r[$z]=$Pc['fields'][$z];}foreach($r
as$z=>$X){if($tb["fields"])$X=$X[0];$K[$z]=(is_array($X)?json_encode($X):$X);}$J[]=$K;}return
new
Min_Result($J);}function
update($U,$We,$Re,$_=0,$N="\n"){$_e=preg_split('~ *= *~',$Re);if(count($_e)==2){$u=trim($_e[1]);$H="$U/$u";return$this->_conn->query($H,$We,'POST');}return
false;}function
insert($U,$We){$u="";$H="$U/$u";$ef=$this->_conn->query($H,$We,'POST');$this->_conn->last_id=$ef['_id'];return$ef['created'];}function
delete($U,$Re,$_=0){$Tc=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Tc[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$Ua){$_e=preg_split('~ *= *~',$Ua);if(count($_e)==2)$Tc[]=trim($_e[1]);}}$this->_conn->affected_rows=0;foreach($Tc
as$u){$H="{$U}/{$u}";$ef=$this->_conn->query($H,'{}','DELETE');if(is_array($ef)&&$ef['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2]))return$i;return$i->error;}function
support($hc){return
preg_match("~database|table|columns~",$hc);}function
logged_user(){global$b;$k=$b->credentials();return$k[1];}function
get_databases(){global$i;$J=$i->rootQuery('_aliases');if($J){$J=array_keys($J);sort($J,SORT_STRING);}return$J;}function
collations(){return
array();}function
db_collation($n,$db){}function
engines(){return
array();}function
count_tables($m){global$i;$J=array();$I=$i->query('_stats');if($I&&$I['indices']){$Zc=$I['indices'];foreach($Zc
as$Yc=>$Nf){$Xc=$Nf['total']['indexing'];$J[$Yc]=$Xc['index_total'];}}return$J;}function
tables_list(){global$i;$J=$i->query('_mapping');if($J)$J=array_fill_keys(array_keys($J[$i->_db]["mappings"]),'table');return$J;}function
table_status($C="",$gc=false){global$i;$of=$i->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$J=array();if($of){$T=$of["aggregations"]["count_by_type"]["buckets"];foreach($T
as$R){$J[$R["key"]]=array("Name"=>$R["key"],"Engine"=>"table","Rows"=>$R["doc_count"],);if($C!=""&&$C==$R["key"])return$J[$C];}}return$J;}function
error(){global$i;return
h($i->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$j=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($R){global$i;$I=$i->query("$R/_mapping");$J=array();if($I){$Gd=$I[$R]['properties'];if(!$Gd)$Gd=$I[$i->_db]['mappings'][$R]['properties'];if($Gd){foreach($Gd
as$C=>$q){$J[$C]=array("field"=>$C,"full_type"=>$q["type"],"type"=>$q["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($q["properties"]){unset($J[$C]["privileges"]["insert"]);unset($J[$C]["privileges"]["update"]);}}}}return$J;}function
foreign_keys($R){return
array();}function
table($v){return$v;}function
idf_escape($v){return$v;}function
convert_field($q){}function
unconvert_field($q,$J){return$J;}function
fk_support($S){}function
found_rows($S,$Z){return
null;}function
create_database($n){global$i;return$i->rootQuery(urlencode($n),null,'PUT');}function
drop_databases($m){global$i;return$i->rootQuery(urlencode(implode(',',$m)),array(),'DELETE');}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){global$i;$Ne=array();foreach($r
as$ec){$ic=trim($ec[1][0]);$jc=trim($ec[1][1]?$ec[1][1]:"text");$Ne[$ic]=array('type'=>$jc);}if(!empty($Ne))$Ne=array('properties'=>$Ne);return$i->query("_mapping/{$C}",$Ne,'PUT');}function
drop_tables($T){global$i;$J=true;foreach($T
as$R)$J=$J&&$i->query(urlencode($R),array(),'DELETE');return$J;}function
last_id(){global$i;return$i->last_id;}$y="elastic";$me=array("=","query");$Cc=array();$Gc=array();$Kb=array(array("json"));$_g=array();$Qf=array();foreach(array(lang(25)=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),lang(26)=>array("date"=>10),lang(23)=>array("string"=>65535,"text"=>65535),lang(27)=>array("binary"=>255),)as$z=>$X){$_g+=$X;$Qf[$z]=array_keys($X);}}$Fb=array("server"=>"MySQL")+$Fb;if(!defined("DRIVER")){$Ge=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($O="",$V="",$G="",$l=null,$Ee=null,$Ef=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Qc,$Ee)=explode(":",$O,2);$Lf=$b->connectSsl();if($Lf)$this->ssl_set($Lf['key'],$Lf['cert'],$Lf['ca'],'','');$J=@$this->real_connect(($O!=""?$Qc:ini_get("mysqli.default_host")),($O.$V!=""?$V:ini_get("mysqli.default_user")),($O.$V.$G!=""?$G:ini_get("mysqli.default_pw")),$l,(is_numeric($Ee)?$Ee:ini_get("mysqli.default_port")),(!is_numeric($Ee)?$Ee:$Ef),($Lf?64:0));return$J;}function
set_charset($Ta){if(parent::set_charset($Ta))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ta");}function
result($H,$q=0){$I=$this->query($H);if(!$I)return
false;$K=$I->fetch_array();return$K[$q];}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!(ini_get("sql.safe_mode")&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$G){$this->_link=@mysql_connect(($O!=""?$O:ini_get("mysql.default_host")),("$O$V"!=""?$V:ini_get("mysql.default_user")),("$O$V$G"!=""?$G:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ta){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ta,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ta");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->_link)."'";}function
select_db($l){return
mysql_select_db($l,$this->_link);}function
query($H,$Ag=false){$I=@($Ag?mysql_unbuffered_query($H,$this->_link):mysql_query($H,$this->_link));$this->error="";if(!$I){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($I===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$q=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;return
mysql_result($I->_result,0,$q);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;$this->num_rows=mysql_num_rows($I);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$J=mysql_fetch_field($this->_result,$this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=($J->blob?63:0);return$J;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($O,$V,$G){global$b;$D=array();$Lf=$b->connectSsl();if($Lf)$D=array(PDO::MYSQL_ATTR_SSL_KEY=>$Lf['key'],PDO::MYSQL_ATTR_SSL_CERT=>$Lf['cert'],PDO::MYSQL_ATTR_SSL_CA=>$Lf['ca'],);$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$G,$D);return
true;}function
set_charset($Ta){$this->query("SET NAMES $Ta");}function
select_db($l){return$this->query("USE ".idf_escape($l));}function
query($H,$Ag=false){$this->setAttribute(1000,!$Ag);return
parent::query($H,$Ag);}}}class
Min_Driver
extends
Min_SQL{function
insert($R,$P){return($P?parent::insert($R,$P):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,$L,$Ie){$g=array_keys(reset($L));$He="INSERT INTO ".table($R)." (".implode(", ",$g).") VALUES\n";$Og=array();foreach($g
as$z)$Og[$z]="$z = VALUES($z)";$Tf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Og);$Og=array();$_d=0;foreach($L
as$P){$Y="(".implode(", ",$P).")";if($Og&&(strlen($He)+$_d+strlen($Y)+strlen($Tf)>1e6)){if(!queries($He.implode(",\n",$Og).$Tf))return
false;$Og=array();$_d=0;}$Og[]=$Y;$_d+=strlen($Y)+2;}return
queries($He.implode(",\n",$Og).$Tf);}function
slowQuery($H,$gg){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$gg FOR $H";elseif(preg_match('~^(SELECT\b)(.+)~is',$H,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($gg*1000).") */ $B[2]";}}function
convertSearch($v,$X,$q){return(preg_match('~char|text|enum|set~',$q["type"])&&!preg_match("~^utf8~",$q["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($v USING ".charset($this->_conn).")":$v);}function
warnings(){$I=$this->_conn->query("SHOW WARNINGS");if($I&&$I->num_rows){ob_start();select($I);return
ob_get_clean();}}function
tableHelp($C){$Hd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Hd?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($Hd?"mysql$C-table/":"system-database.html");}}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
table($v){return
idf_escape($v);}function
connect(){global$b,$_g,$Qf;$i=new
Min_DB;$k=$b->credentials();if($i->connect($k[0],$k[1],$k[2])){$i->set_charset(charset($i));$i->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$i)){$Qf[lang(23)][]="json";$_g["json"]=4294967295;}return$i;}$J=$i->error;if(function_exists('iconv')&&!is_utf8($J)&&strlen($lf=iconv("windows-1250","utf-8",$J))>strlen($J))$J=$lf;return$J;}function
get_databases($rc){$J=get_session("dbs");if($J===null){$H=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA":"SHOW DATABASES");$J=($rc?slow_query($H):get_vals($H));restart_session();set_session("dbs",$J);stop_session();}return$J;}function
limit($H,$Z,$_,$fe=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($fe?" OFFSET $fe":""):"");}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($n,$db){global$i;$J=null;$ob=$i->result("SHOW CREATE DATABASE ".idf_escape($n),1);if(preg_match('~ COLLATE ([^ ]+)~',$ob,$B))$J=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$ob,$B))$J=$db[$B[1]][-1];return$J;}function
engines(){$J=array();foreach(get_rows("SHOW ENGINES")as$K){if(preg_match("~YES|DEFAULT~",$K["Support"]))$J[]=$K["Engine"];}return$J;}function
logged_user(){global$i;return$i->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($m){$J=array();foreach($m
as$n)$J[$n]=count(get_vals("SHOW TABLES IN ".idf_escape($n)));return$J;}function
table_status($C="",$gc=false){$J=array();foreach(get_rows($gc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$K){if($K["Engine"]=="InnoDB")$K["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$K["Comment"]);if(!isset($K["Engine"]))$K["Comment"]="";if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]===null;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"])||(preg_match('~NDB~i',$S["Engine"])&&min_version(5.6));}function
fields($R){$J=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($R))as$K){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$K["Type"],$B);$J[$K["Field"]]=array("field"=>$K["Field"],"full_type"=>$K["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($K["Default"]!=""||preg_match("~char|set~",$B[1])?$K["Default"]:null),"null"=>($K["Null"]=="YES"),"auto_increment"=>($K["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$K["Extra"],$B)?$B[1]:""),"collation"=>$K["Collation"],"privileges"=>array_flip(preg_split('~, *~',$K["Privileges"])),"comment"=>$K["Comment"],"primary"=>($K["Key"]=="PRI"),);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$j)as$K){$C=$K["Key_name"];$J[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($K["Index_type"]=="FULLTEXT"?"FULLTEXT":($K["Non_unique"]?($K["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$J[$C]["columns"][]=$K["Column_name"];$J[$C]["lengths"][]=($K["Index_type"]=="SPATIAL"?null:$K["Sub_part"]);$J[$C]["descs"][]=null;}return$J;}function
foreign_keys($R){global$i,$he;static$Be='`(?:[^`]|``)+`';$J=array();$pb=$i->result("SHOW CREATE TABLE ".table($R),1);if($pb){preg_match_all("~CONSTRAINT ($Be) FOREIGN KEY ?\\(((?:$Be,? ?)+)\\) REFERENCES ($Be)(?:\\.($Be))? \\(((?:$Be,? ?)+)\\)(?: ON DELETE ($he))?(?: ON UPDATE ($he))?~",$pb,$Kd,PREG_SET_ORDER);foreach($Kd
as$B){preg_match_all("~$Be~",$B[2],$Gf);preg_match_all("~$Be~",$B[5],$ag);$J[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$Gf[0]),"target"=>array_map('idf_unescape',$ag[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$i->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$J=array();foreach(get_rows("SHOW COLLATION")as$K){if($K["Default"])$J[$K["Charset"]][-1]=$K["Collation"];else$J[$K["Charset"]][]=$K["Collation"];}ksort($J);foreach($J
as$z=>$X)asort($J[$z]);return$J;}function
information_schema($n){return(min_version(5)&&$n=="information_schema")||(min_version(5.5)&&$n=="performance_schema");}function
error(){global$i;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$i->error));}function
create_database($n,$e){return
queries("CREATE DATABASE ".idf_escape($n).($e?" COLLATE ".q($e):""));}function
drop_databases($m){$J=apply_queries("DROP DATABASE",$m,'idf_escape');restart_session();set_session("dbs",null);return$J;}function
rename_database($C,$e){$J=false;if(create_database($C,$e)){$bf=array();foreach(tables_list()as$R=>$U)$bf[]=table($R)." TO ".idf_escape($C).".".table($R);$J=(!$bf||queries("RENAME TABLE ".implode(", ",$bf)));if($J)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$J;}function
auto_increment(){$Ga=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$w){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$w["columns"],true)){$Ga="";break;}if($w["type"]=="PRIMARY")$Ga=" UNIQUE";}}return" AUTO_INCREMENT$Ga";}function
alter_table($R,$C,$r,$tc,$hb,$Rb,$e,$Fa,$ze){$c=array();foreach($r
as$q)$c[]=($q[1]?($R!=""?($q[0]!=""?"CHANGE ".idf_escape($q[0]):"ADD"):" ")." ".implode($q[1]).($R!=""?$q[2]:""):"DROP ".idf_escape($q[0]));$c=array_merge($c,$tc);$Of=($hb!==null?" COMMENT=".q($hb):"").($Rb?" ENGINE=".q($Rb):"").($e?" COLLATE ".q($e):"").($Fa!=""?" AUTO_INCREMENT=$Fa":"");if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$Of$ze");if($R!=$C)$c[]="RENAME TO ".table($C);if($Of)$c[]=ltrim($Of);return($c||$ze?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$ze):true);}function
alter_indexes($R,$c){foreach($c
as$z=>$X)$c[$z]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$c));}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Sg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Sg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Sg,$ag){$bf=array();foreach(array_merge($T,$Sg)as$R)$bf[]=table($R)." TO ".idf_escape($ag).".".table($R);return
queries("RENAME TABLE ".implode(", ",$bf));}function
copy_tables($T,$Sg,$ag){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$C=($ag==DB?table("copy_$R"):idf_escape($ag).".".table($R));if(!queries("\nDROP TABLE IF EXISTS $C")||!queries("CREATE TABLE $C LIKE ".table($R))||!queries("INSERT INTO $C SELECT * FROM ".table($R)))return
false;}foreach($Sg
as$R){$C=($ag==DB?table("copy_$R"):idf_escape($ag).".".table($R));$Rg=view($R);if(!queries("DROP VIEW IF EXISTS $C")||!queries("CREATE VIEW $C AS $Rg[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$L=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$K)$J[$K["Trigger"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$U){global$i,$Sb,$ed,$_g;$xa=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Hf="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$zg="((".implode("|",array_merge(array_keys($_g),$xa)).")\\b(?:\\s*\\(((?:[^'\")]|$Sb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Be="$Hf*(".($U=="FUNCTION"?"":$ed).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$zg";$ob=$i->result("SHOW CREATE $U ".idf_escape($C),2);preg_match("~\\(((?:$Be\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$zg\\s+":"")."(.*)~is",$ob,$B);$r=array();preg_match_all("~$Be\\s*,?~is",$B[1],$Kd,PREG_SET_ORDER);foreach($Kd
as$we){$C=str_replace("``","`",$we[2]).$we[3];$r[]=array("field"=>$C,"type"=>strtolower($we[5]),"length"=>preg_replace_callback("~$Sb~s",'normalize_enum',$we[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$we[8] $we[7]"))),"null"=>1,"full_type"=>$we[4],"inout"=>strtoupper($we[1]),"collation"=>strtolower($we[9]),);}if($U!="FUNCTION")return
array("fields"=>$r,"definition"=>$B[11]);return
array("fields"=>$r,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$K){return
idf_escape($C);}function
last_id(){global$i;return$i->result("SELECT LAST_INSERT_ID()");}function
explain($i,$H){return$i->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$H);}function
found_rows($S,$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($mf){return
true;}function
create_sql($R,$Fa,$Rf){global$i;$J=$i->result("SHOW CREATE TABLE ".table($R),1);if(!$Fa)$J=preg_replace('~ AUTO_INCREMENT=\d+~','',$J);return$J;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($l){return"USE ".idf_escape($l);}function
trigger_sql($R){$J="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$K)$J.="\nCREATE TRIGGER ".idf_escape($K["Trigger"])." $K[Timing] $K[Event] ON ".table($K["Table"])." FOR EACH ROW\n$K[Statement];;\n";return$J;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($q){if(preg_match("~binary~",$q["type"]))return"HEX(".idf_escape($q["field"]).")";if($q["type"]=="bit")return"BIN(".idf_escape($q["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$q["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($q["field"]).")";}function
unconvert_field($q,$J){if(preg_match("~binary~",$q["type"]))$J="UNHEX($J)";if($q["type"]=="bit")$J="CONV($J, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$q["type"]))$J=(min_version(8)?"ST_":"")."GeomFromText($J)";return$J;}function
support($hc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))."~",$hc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$i;return$i->result("SELECT @@max_connections");}$y="sql";$_g=array();$Qf=array();foreach(array(lang(25)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(26)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(23)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(30)=>array("enum"=>65535,"set"=>64),lang(27)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(29)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$z=>$X){$_g+=$X;$Qf[$z]=array_keys($X);}$Gg=array("unsigned","zerofill","unsigned zerofill");$me=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Cc=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$Gc=array("avg","count","count distinct","group_concat","max","min","sum");$Kb=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\1',$_SERVER["REQUEST_URI"]).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ca="4.6.3-dev";class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".lang(31)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($ob=false){return
password_file($ob);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($O){}function
database(){global$i;if($i){$m=$this->databases(false);return(!$m?$i->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$m[(information_schema($m[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($rc=true){return
get_databases($rc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$J=array();$s="adminer.css";if(file_exists($s))$J[]=$s;return$J;}function
loginForm(){echo"<table cellspacing='0'>\n",$this->loginFormField('username','<tr><th>'.lang(32).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.lang(33).'<td>','<input type="password" name="auth[password]">'."\n"),"</table>\n","<p><input type='submit' value='".lang(34)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(35))."\n";}function
loginFormField($C,$Nc,$Y){return$Nc.$Y;}function
login($Ed,$G){return
true;}function
tableName($Wf){return
h($Wf["Comment"]!=""?$Wf["Comment"]:$Wf["Name"]);}function
fieldName($q,$pe=0){return
h(preg_replace('~\s+\[.*\]$~','',($q["comment"]!=""?$q["comment"]:$q["field"])));}function
selectLinks($Wf,$P=""){$a=$Wf["Name"];if($P!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$P).'">'.lang(36)."</a>\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$Vf){$J=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($R)."
ORDER BY ORDINAL_POSITION",null,"")as$K)$J[$K["TABLE_NAME"]]["keys"][$K["CONSTRAINT_NAME"]][$K["COLUMN_NAME"]]=$K["REFERENCED_COLUMN_NAME"];foreach($J
as$z=>$X){$C=$this->tableName(table_status($z,true));if($C!=""){$of=preg_quote($Vf);$N="(:|\\s*-)?\\s+";$J[$z]["name"]=(preg_match("(^$of$N(.+)|^(.+?)$N$of\$)iu",$C,$B)?$B[2].$B[3]:$C);}else
unset($J[$z]);}return$J;}function
backwardKeysPrint($Ja,$K){foreach($Ja
as$R=>$Ia){foreach($Ia["keys"]as$fb){$A=ME.'select='.urlencode($R);$t=0;foreach($fb
as$f=>$X)$A.=where_link($t++,$f,$K[$X]);echo"<a href='".h($A)."'>".h($Ia["name"])."</a>";$A=ME.'edit='.urlencode($R);foreach($fb
as$f=>$X)$A.="&set".urlencode("[".bracket_escape($f)."]")."=".urlencode($K[$X]);echo"<a href='".h($A)."' title='".lang(36)."'>+</a> ";}}}function
selectQuery($H,$Mf,$fc=false){return"<!--\n".str_replace("--","--><!-- ",$H)."\n(".format_time($Mf).")\n-->\n";}function
rowDescription($R){foreach(fields($R)as$q){if(preg_match("~varchar|character varying~",$q["type"]))return
idf_escape($q["field"]);}return"";}function
rowDescriptions($L,$vc){$J=$L;foreach($L[0]as$z=>$X){if(list($R,$u,$C)=$this->_foreignColumn($vc,$z)){$Tc=array();foreach($L
as$K)$Tc[$K[$z]]=q($K[$z]);$_b=$this->_values[$R];if(!$_b)$_b=get_key_vals("SELECT $u, $C FROM ".table($R)." WHERE $u IN (".implode(", ",$Tc).")");foreach($L
as$Xd=>$K){if(isset($K[$z]))$J[$Xd][$z]=(string)$_b[$K[$z]];}}}return$J;}function
selectLink($X,$q){}function
selectVal($X,$A,$q,$re){$J=$X;$A=h($A);if(preg_match('~blob|bytea~',$q["type"])&&!is_utf8($X)){$J=lang(37,strlen($re));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$re))$J="<img src='$A' alt='$J'>";}if(like_bool($q)&&$J!="")$J=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(38):lang(39));if($A)$J="<a href='$A'".(is_url($A)?target_blank():"").">$J</a>";if(!$A&&!like_bool($q)&&preg_match(number_type(),$q["type"]))$J="<div class='number'>$J</div>";elseif(preg_match('~date~',$q["type"]))$J="<div class='datetime'>$J</div>";return$J;}function
editVal($X,$q){if(preg_match('~date|timestamp~',$q["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(40),$X);return$X;}function
selectColumnsPrint($M,$g){}function
selectSearchPrint($Z,$g,$x){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(41)."</legend><div>\n";$rd=array();foreach($Z
as$z=>$X)$rd[$X["col"]]=$z;$t=0;$r=fields($_GET["select"]);foreach($g
as$C=>$zb){$q=$r[$C];if(preg_match("~enum~",$q["type"])||like_bool($q)){$z=$rd[$C];$t--;echo"<div>".h($zb)."<input type='hidden' name='where[$t][col]' value='".h($C)."'>:",(like_bool($q)?" <select name='where[$t][val]'>".optionlist(array(""=>"",lang(39),lang(38)),$Z[$z]["val"],true)."</select>":enum_input("checkbox"," name='where[$t][val][]'",$q,(array)$Z[$z]["val"],($q["null"]?0:null))),"</div>\n";unset($g[$C]);}elseif(is_array($D=$this->_foreignKeyOptions($_GET["select"],$C))){if($r[$C]["null"])$D[0]='('.lang(7).')';$z=$rd[$C];$t--;echo"<div>".h($zb)."<input type='hidden' name='where[$t][col]' value='".h($C)."'><input type='hidden' name='where[$t][op]' value='='>: <select name='where[$t][val]'>".optionlist($D,$Z[$z]["val"],true)."</select></div>\n";unset($g[$C]);}}$t=0;foreach($Z
as$X){if(($X["col"]==""||$g[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$t][col]'><option value=''>(".lang(42).")".optionlist($g,$X["col"],true)."</select>",html_select("where[$t][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$t][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$t++;}}echo"<div><select name='where[$t][col]'><option value=''>(".lang(42).")".optionlist($g,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$t][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$t][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($pe,$g,$x){$qe=array();foreach($x
as$z=>$w){$pe=array();foreach($w["columns"]as$X)$pe[]=$g[$X];if(count(array_filter($pe,'strlen'))>1&&$z!="PRIMARY")$qe[$z]=implode(", ",$pe);}if($qe){echo'<fieldset><legend>'.lang(43)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$qe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($_){echo"<fieldset><legend>".lang(44)."</legend><div>";echo
html_select("limit",array("","50","100"),$_),"</div></fieldset>\n";}function
selectLengthPrint($dg){}function
selectActionPrint($x){echo"<fieldset><legend>".lang(45)."</legend><div>","<input type='submit' value='".lang(46)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Ob,$g){if($Ob){print_fieldset("email",lang(47),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(48).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(49).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$g,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(11)."'>\n";echo"<p>".lang(50).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Ob)==1?'<input type="hidden" name="email_field" value="'.h(key($Ob)).'">':html_select("email_field",$Ob)),"<input type='submit' name='email' value='".lang(51)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($g,$x){return
array(array(),array());}function
selectSearchProcess($r,$x){$J=array();foreach((array)$_GET["where"]as$z=>$Z){$cb=$Z["col"];$ke=$Z["op"];$X=$Z["val"];if(($z<0?"":$cb).$X!=""){$ib=array();foreach(($cb!=""?array($cb=>$r[$cb]):$r)as$C=>$q){if($cb!=""||is_numeric($X)||!preg_match(number_type(),$q["type"])){$C=idf_escape($C);if($cb!=""&&$q["type"]=="enum")$ib[]=(in_array(0,$X)?"$C IS NULL OR ":"")."$C IN (".implode(", ",array_map('intval',$X)).")";else{$eg=preg_match('~char|text|enum|set~',$q["type"]);$Y=$this->processInput($q,(!$ke&&$eg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$ib[]=$C.($Y=="NULL"?" IS".($ke==">="?" NOT":"")." $Y":(in_array($ke,$this->operators)||$ke=="="?" $ke $Y":($eg?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($z<0&&$X=="0")$ib[]="$C IS NULL";}}}$J[]=($ib?"(".implode(" OR ",$ib).")":"1 = 0");}}return$J;}function
selectOrderProcess($r,$x){$Wc=$_GET["index_order"];if($Wc!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($Wc!=""?array($x[$Wc]):$x)as$w){if($Wc!=""||$w["type"]=="INDEX"){$Ic=array_filter($w["descs"]);$zb=false;foreach($w["columns"]as$X){if(preg_match('~date|timestamp~',$r[$X]["type"])){$zb=true;break;}}$J=array();foreach($w["columns"]as$z=>$X)$J[]=idf_escape($X).(($Ic?$w["descs"][$z]:$zb)?" DESC":"");return$J;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$vc){if($_POST["email_append"])return
true;if($_POST["email"]){$tf=0;if($_POST["all"]||$_POST["check"]){$q=idf_escape($_POST["email_field"]);$Sf=$_POST["email_subject"];$Qd=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Sf.$Qd",$Kd);$L=get_rows("SELECT DISTINCT $q".($Kd[1]?", ".implode(", ",array_map('idf_escape',array_unique($Kd[1]))):"")." FROM ".table($_GET["select"])." WHERE $q IS NOT NULL AND $q != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$r=fields($_GET["select"]);foreach($this->rowDescriptions($L,$vc)as$K){$cf=array('{\\'=>'{');foreach($Kd[1]as$X)$cf['{$'."$X}"]=$this->editVal($K[$X],$r[$X]);$Nb=$K[$_POST["email_field"]];if(is_mail($Nb)&&send_mail($Nb,strtr($Sf,$cf),strtr($Qd,$cf),$_POST["email_from"],$_FILES["email_files"]))$tf++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(52,$tf));}return
false;}function
selectQueryBuild($M,$Z,$Dc,$pe,$_,$E){return"";}function
messageQuery($H,$fg,$fc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$H)."\n".($fg?"($fg)\n":"")."-->";}function
editFunctions($q){$J=array();if($q["null"]&&preg_match('~blob~',$q["type"]))$J["NULL"]=lang(7);$J[""]=($q["null"]||$q["auto_increment"]||like_bool($q)?"":"*");if(preg_match('~date|time~',$q["type"]))$J["now"]=lang(53);if(preg_match('~_(md5|sha1)$~i',$q["field"],$B))$J[]=strtolower($B[1]);return$J;}function
editInput($R,$q,$Da,$Y){if($q["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Da value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$Da,$q,($Y||isset($_GET["select"])?$Y:0),($q["null"]?"":null));$D=$this->_foreignKeyOptions($R,$q["field"],$Y);if($D!==null)return(is_array($D)?"<select$Da>".optionlist($D,$Y,true)."</select>":"<input value='".h($Y)."'$Da class='hidden'>"."<input value='".h($D)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($R)."&field=".urlencode($q["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($q))return'<input type="checkbox" value="'.h($Y?$Y:1).'"'.($Y?' checked':'')."$Da>";$Oc="";if(preg_match('~time~',$q["type"]))$Oc=lang(54);if(preg_match('~date|timestamp~',$q["type"]))$Oc=lang(55).($Oc?" [$Oc]":"");if($Oc)return"<input value='".h($Y)."'$Da> ($Oc)";if(preg_match('~_(md5|sha1)$~i',$q["field"]))return"<input type='password' value='".h($Y)."'$Da>";return'';}function
editHint($R,$q,$Y){return(preg_match('~\s+(\[.*\])$~',($q["comment"]!=""?$q["comment"]:$q["field"]),$B)?h(" $B[1]"):'');}function
processInput($q,$Y,$Bc=""){if($Bc=="now")return"$Bc()";$J=$Y;if(preg_match('~date|timestamp~',$q["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(40)))).'(.*))',$Y,$B))$J=($B["p1"]!=""?$B["p1"]:($B["p2"]!=""?($B["p2"]<70?20:19).$B["p2"]:gmdate("Y")))."-$B[p3]$B[p4]-$B[p5]$B[p6]".end($B);$J=($q["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$J:q($J));if($Y==""&&like_bool($q))$J="0";elseif($Y==""&&($q["null"]||!preg_match('~char|text~',$q["type"])))$J="NULL";elseif(preg_match('~^(md5|sha1)$~',$Bc))$J="$Bc($J)";return
unconvert_field($q,$J);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($n){}function
dumpTable($R,$Rf,$ld=0){echo"\xef\xbb\xbf";}function
dumpData($R,$Rf,$H){global$i;$I=$i->query($H,1);if($I){while($K=$I->fetch_assoc()){if($Rf=="table"){dump_csv(array_keys($K));$Rf="INSERT";}dump_csv($K);}}}function
dumpFilename($Sc){return
friendly_url($Sc);}function
dumpHeaders($Sc,$Vd=false){$bc="csv";header("Content-Type: text/csv; charset=utf-8");return$bc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Ud){global$ca;echo'<h1>
',$this->name(),' <span class="version">',$ca,'</span>
<a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Ud=="auth"){$nc=true;foreach((array)$_SESSION["pwds"]as$Pg=>$zf){foreach($zf[""]as$V=>$G){if($G!==null){if($nc){echo"<p id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$nc=false;}echo"<a href='".h(auth_url($Pg,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a><br>\n";}}}}else{$this->databasesPrint($Ud);if($Ud!="db"&&$Ud!="ns"){$S=table_status('',true);if(!$S)echo"<p class='message'>".lang(9)."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Ud){}function
tablesPrint($T){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$K){echo'<li>';$C=$this->tableName($K);if(isset($K["Engine"])&&$C!="")echo"<a href='".h(ME).'select='.urlencode($K["Name"])."'".bold($_GET["select"]==$K["Name"]||$_GET["edit"]==$K["Name"],"select")." title='".lang(56)."'>$C</a>\n";}echo"</ul>\n";}function
_foreignColumn($vc,$f){foreach((array)$vc[$f]as$uc){if(count($uc["source"])==1){$C=$this->rowDescription($uc["table"]);if($C!=""){$u=idf_escape($uc["target"][0]);return
array($uc["table"],$u,$C);}}}}function
_foreignKeyOptions($R,$f,$Y=null){global$i;if(list($ag,$u,$C)=$this->_foreignColumn(column_foreign_keys($R),$f)){$J=&$this->_values[$ag];if($J===null){$S=table_status($ag);$J=($S["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $u, $C FROM ".table($ag)." ORDER BY 2"));}if(!$J&&$Y!==null)return$i->result("SELECT $C FROM ".table($ag)." WHERE $u = ".q($Y));return$J;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);function
page_header($ig,$p="",$Ra=array(),$jg=""){global$ba,$ca,$b,$Fb,$y;page_headers();if(is_ajax()&&$p){page_messages($p);exit;}$kg=$ig.($jg!=""?": $jg":"");$lg=strip_tags($kg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(57),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$lg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.6.3-dev"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.6.3-dev");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3-dev"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3-dev"),'">
';foreach($b->css()as$rb){echo'<link rel="stylesheet" type="text/css" href="',h($rb),'">
';}}echo'
<body class="',lang(57),' nojs">
';$s=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($s)&&filemtime($s)+86400>time()){$Qg=unserialize(file_get_contents($s));$Oe="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Qg["version"],base64_decode($Qg["signature"]),$Oe)==1)$_COOKIE["adminer_version"]=$Qg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(58)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$y,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Ra!==null){$A=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($A?$A:".").'">'.$Fb[DRIVER].'</a> &raquo; ';$A=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$O=$b->serverName(SERVER);$O=($O!=""?$O:lang(59));if($Ra===false)echo"$O\n";else{echo"<a href='".($A?h($A):".")."' accesskey='1' title='Alt+Shift+1'>$O</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Ra)))echo'<a href="'.h($A."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Ra)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Ra
as$z=>$X){$zb=(is_array($X)?$X[1]:h($X));if($zb!="")echo"<a href='".h(ME."$z=").urlencode(is_array($X)?$X[0]:$X)."'>$zb</a> &raquo; ";}}echo"$ig\n";}}echo"<h2>$kg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($p);$m=&get_session("dbs");if(DB!=""&&$m&&!in_array(DB,$m,true))$m=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$qb){$Lc=array();foreach($qb
as$z=>$X)$Lc[]="$z $X";header("Content-Security-Policy: ".implode("; ",$Lc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$be;if(!$be)$be=base64_encode(rand_string());return$be;}function
page_messages($p){$Ig=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Rd=$_SESSION["messages"][$Ig];if($Rd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Rd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ig]);}if($p)echo"<div class='error'>$p</div>\n";}function
page_footer($Ud=""){global$b,$og;echo'</div>

';switch_lang();if($Ud!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="',lang(60),'" id="logout">
<input type="hidden" name="token" value="',$og,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Ud);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Xd){while($Xd>=2147483648)$Xd-=4294967296;while($Xd<=-2147483649)$Xd+=4294967296;return(int)$Xd;}function
long2str($W,$Ug){$lf='';foreach($W
as$X)$lf.=pack('V',$X);if($Ug)return
substr($lf,0,end($W));return$lf;}function
str2long($lf,$Ug){$W=array_values(unpack('V*',str_pad($lf,4*ceil(strlen($lf)/4),"\0")));if($Ug)$W[]=strlen($lf);return$W;}function
xxtea_mx($fh,$eh,$Uf,$nd){return
int32((($fh>>5&0x7FFFFFF)^$eh<<2)+(($eh>>3&0x1FFFFFFF)^$fh<<4))^int32(($Uf^$eh)+($nd^$fh));}function
encrypt_string($Pf,$z){if($Pf=="")return"";$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Pf,true);$Xd=count($W)-1;$fh=$W[$Xd];$eh=$W[0];$Pe=floor(6+52/($Xd+1));$Uf=0;while($Pe-->0){$Uf=int32($Uf+0x9E3779B9);$Jb=$Uf>>2&3;for($ue=0;$ue<$Xd;$ue++){$eh=$W[$ue+1];$Wd=xxtea_mx($fh,$eh,$Uf,$z[$ue&3^$Jb]);$fh=int32($W[$ue]+$Wd);$W[$ue]=$fh;}$eh=$W[0];$Wd=xxtea_mx($fh,$eh,$Uf,$z[$ue&3^$Jb]);$fh=int32($W[$Xd]+$Wd);$W[$Xd]=$fh;}return
long2str($W,false);}function
decrypt_string($Pf,$z){if($Pf=="")return"";if(!$z)return
false;$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Pf,false);$Xd=count($W)-1;$fh=$W[$Xd];$eh=$W[0];$Pe=floor(6+52/($Xd+1));$Uf=int32($Pe*0x9E3779B9);while($Uf){$Jb=$Uf>>2&3;for($ue=$Xd;$ue>0;$ue--){$fh=$W[$ue-1];$Wd=xxtea_mx($fh,$eh,$Uf,$z[$ue&3^$Jb]);$eh=int32($W[$ue]-$Wd);$W[$ue]=$eh;}$fh=$W[$Xd];$Wd=xxtea_mx($fh,$eh,$Uf,$z[$ue&3^$Jb]);$eh=int32($W[0]-$Wd);$W[0]=$eh;$Uf=int32($Uf-0x9E3779B9);}return
long2str($W,true);}$i='';$Kc=$_SESSION["token"];if(!$Kc)$_SESSION["token"]=rand(1,1e6);$og=get_token();$Ce=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($z)=explode(":",$X);$Ce[$z]=$X;}}function
add_invalid_login(){global$b;$_c=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$_c)return;$id=unserialize(stream_get_contents($_c));$fg=time();if($id){foreach($id
as$jd=>$X){if($X[0]<$fg)unset($id[$jd]);}}$hd=&$id[$b->bruteForceKey()];if(!$hd)$hd=array($fg+30*60,0);$hd[1]++;file_write_unlock($_c,serialize($id));}function
check_invalid_login(){global$b;$id=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$hd=$id[$b->bruteForceKey()];$ae=($hd[1]>29?$hd[0]-time():0);if($ae>0)auth_error(lang(61,ceil($ae/60)));}$Ea=$_POST["auth"];if($Ea){session_regenerate_id();$Pg=$Ea["driver"];$O=$Ea["server"];$V=$Ea["username"];$G=(string)$Ea["password"];$n=$Ea["db"];set_password($Pg,$O,$V,$G);$_SESSION["db"][$Pg][$O][$V][$n]=true;if($Ea["permanent"]){$z=base64_encode($Pg)."-".base64_encode($O)."-".base64_encode($V)."-".base64_encode($n);$Le=$b->permanentLogin(true);$Ce[$z]="$z:".base64_encode($Le?encrypt_string($G,$Le):"");cookie("adminer_permanent",implode(" ",$Ce));}if(count($_POST)==1||DRIVER!=$Pg||SERVER!=$O||$_GET["username"]!==$V||DB!=$n)redirect(auth_url($Pg,$O,$V,$n));}elseif($_POST["logout"]){if($Kc&&!verify_token()){page_header(lang(60),lang(62));page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$z)set_session($z,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(63).' '.lang(64,'https://sourceforge.net/donate/index.php?group_id=264133'));}}elseif($Ce&&!$_SESSION["pwds"]){session_regenerate_id();$Le=$b->permanentLogin();foreach($Ce
as$z=>$X){list(,$Za)=explode(":",$X);list($Pg,$O,$V,$n)=array_map('base64_decode',explode("-",$z));set_password($Pg,$O,$V,decrypt_string(base64_decode($Za),$Le));$_SESSION["db"][$Pg][$O][$V][$n]=true;}}function
unset_permanent(){global$Ce;foreach($Ce
as$z=>$X){list($Pg,$O,$V,$n)=array_map('base64_decode',explode("-",$z));if($Pg==DRIVER&&$O==SERVER&&$V==$_GET["username"]&&$n==DB)unset($Ce[$z]);}cookie("adminer_permanent",implode(" ",$Ce));}function
auth_error($p){global$b,$Kc;$_f=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$_f]||$_GET[$_f])&&!$Kc)$p=lang(65);else{restart_session();add_invalid_login();$G=get_password();if($G!==null){if($G===false)$p.='<br>'.lang(66,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$_f]&&$_GET[$_f]&&ini_bool("session.use_only_cookies"))$p=lang(67);$F=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$F["lifetime"]);page_header(lang(34),$p,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(68)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(69),lang(70,implode(", ",$Ge)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])){list($Qc,$Ee)=explode(":",SERVER,2);if(is_numeric($Ee)&&$Ee<1024)auth_error(lang(71));check_invalid_login();$i=connect();$o=new
Min_Driver($i);}$Ed=null;if(!is_object($i)||($Ed=$b->login($_GET["username"],get_password()))!==true)auth_error((is_string($i)?h($i):(is_string($Ed)?$Ed:lang(72))));if($Ea&&$_POST["token"])$_POST["token"]=$og;$p='';if($_POST){if(!verify_token()){$dd="max_input_vars";$Od=ini_get($dd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$z){$X=ini_get($z);if($X&&(!$Od||$X<$Od)){$dd=$z;$Od=$X;}}}$p=(!$_POST["token"]&&$Od?lang(73,"'$dd'"):lang(62).' '.lang(74));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$p=lang(75,"'post_max_size'");if(isset($_GET["sql"]))$p.=' '.lang(76);}function
email_header($Lc){return"=?UTF-8?B?".base64_encode($Lc)."?=";}function
send_mail($Nb,$Sf,$Qd,$Ac="",$lc=array()){$Tb=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Qd=str_replace("\n",$Tb,wordwrap(str_replace("\r","","$Qd\n")));$Qa=uniqid("boundary");$Ba="";foreach((array)$lc["error"]as$z=>$X){if(!$X)$Ba.="--$Qa$Tb"."Content-Type: ".str_replace("\n","",$lc["type"][$z]).$Tb."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$lc["name"][$z])."\"$Tb"."Content-Transfer-Encoding: base64$Tb$Tb".chunk_split(base64_encode(file_get_contents($lc["tmp_name"][$z])),76,$Tb).$Tb;}$La="";$Mc="Content-Type: text/plain; charset=utf-8$Tb"."Content-Transfer-Encoding: 8bit";if($Ba){$Ba.="--$Qa--$Tb";$La="--$Qa$Tb$Mc$Tb$Tb";$Mc="Content-Type: multipart/mixed; boundary=\"$Qa\"";}$Mc.=$Tb."MIME-Version: 1.0$Tb"."X-Mailer: Adminer Editor".($Ac?$Tb."From: ".str_replace("\n","",$Ac):"");return
mail($Nb,email_header($Sf),$La.$Qd.$Ba,$Mc);}function
like_bool($q){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$q["full_type"]);}$i->select_db($b->database());$he="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Fb[DRIVER]=lang(34);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$r=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$M=array(idf_escape($_GET["field"]));$I=$o->select($a,$M,array(where($_GET,$r)),$M);$K=($I?$I->fetch_row():array());echo$o->value($K[0],$r[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$r=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$r):""):where($_GET,$r));$Hg=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($r
as$C=>$q){if(!isset($q["privileges"][$Hg?"update":"insert"])||$b->fieldName($q)=="")unset($r[$C]);}if($_POST&&!$p&&!isset($_GET["select"])){$Dd=$_POST["referer"];if($_POST["insert"])$Dd=($Hg?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Dd))$Dd=ME."select=".urlencode($a);$x=indexes($a);$Cg=unique_array($_GET["where"],$x);$Se="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Dd,lang(77),$o->delete($a,$Se,!$Cg));else{$P=array();foreach($r
as$C=>$q){$X=process_input($q);if($X!==false&&$X!==null)$P[idf_escape($C)]=$X;}if($Hg){if(!$P)redirect($Dd);queries_redirect($Dd,lang(78),$o->update($a,$P,$Se,!$Cg));if(is_ajax()){page_headers();page_messages($p);exit;}}else{$I=$o->insert($a,$P);$yd=($I?last_id():0);queries_redirect($Dd,lang(79,($yd?" $yd":"")),$I);}}}$K=null;if($_POST["save"])$K=(array)$_POST["fields"];elseif($Z){$M=array();foreach($r
as$C=>$q){if(isset($q["privileges"]["select"])){$_a=convert_field($q);if($_POST["clone"]&&$q["auto_increment"])$_a="''";if($y=="sql"&&preg_match("~enum|set~",$q["type"]))$_a="1*".idf_escape($C);$M[]=($_a?"$_a AS ":"").idf_escape($C);}}$K=array();if(!support("table"))$M=array("*");if($M){$I=$o->select($a,$M,array($Z),$M,array(),(isset($_GET["select"])?2:1));if(!$I)$p=error();else{$K=$I->fetch_assoc();if(!$K)$K=false;}if(isset($_GET["select"])&&(!$K||$I->fetch_assoc()))$K=null;}}if(!support("table")&&!$r){if(!$Z){$I=$o->select($a,array("*"),$Z,array("*"));$K=($I?$I->fetch_assoc():false);if(!$K)$K=array($o->primary=>"");}if($K){foreach($K
as$z=>$X){if(!$Z)$K[$z]=null;$r[$z]=array("field"=>$z,"null"=>($z!=$o->primary),"auto_increment"=>($z==$o->primary));}}}edit_form($a,$r,$K,$Hg);}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$x=indexes($a);$r=fields($a);$xc=column_foreign_keys($a);$ge=$S["Oid"];parse_str($_COOKIE["adminer_import"],$ta);$jf=array();$g=array();$dg=null;foreach($r
as$z=>$q){$C=$b->fieldName($q);if(isset($q["privileges"]["select"])&&$C!=""){$g[$z]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($q))$dg=$b->selectLengthProcess();}$jf+=$q["privileges"];}list($M,$Dc)=$b->selectColumnsProcess($g,$x);$kd=count($Dc)<count($M);$Z=$b->selectSearchProcess($r,$x);$pe=$b->selectOrderProcess($r,$x);$_=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Dg=>$K){$_a=convert_field($r[key($K)]);$M=array($_a?$_a:idf_escape(key($K)));$Z[]=where_check($Dg,$r);$J=$o->select($a,$M,$Z,$M);if($J)echo
reset($J->fetch_row());}exit;}$Ie=$Fg=null;foreach($x
as$w){if($w["type"]=="PRIMARY"){$Ie=array_flip($w["columns"]);$Fg=($M?$Ie:array());foreach($Fg
as$z=>$X){if(in_array(idf_escape($z),$M))unset($Fg[$z]);}break;}}if($ge&&!$Ie){$Ie=$Fg=array($ge=>0);$x[]=array("type"=>"PRIMARY","columns"=>array($ge));}if($_POST&&!$p){$Zg=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Xa=array();foreach($_POST["check"]as$Ua)$Xa[]=where_check($Ua,$r);$Zg[]="((".implode(") OR (",$Xa)."))";}$Zg=($Zg?"\nWHERE ".implode(" AND ",$Zg):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Ac=($M?implode(", ",$M):"*").convert_fields($g,$r,$M)."\nFROM ".table($a);$Fc=($Dc&&$kd?"\nGROUP BY ".implode(", ",$Dc):"").($pe?"\nORDER BY ".implode(", ",$pe):"");if(!is_array($_POST["check"])||$Ie)$H="SELECT $Ac$Zg$Fc";else{$Bg=array();foreach($_POST["check"]as$X)$Bg[]="(SELECT".limit($Ac,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$r).$Fc,1).")";$H=implode(" UNION ALL ",$Bg);}$b->dumpData($a,"table",$H);exit;}if(!$b->selectEmailProcess($Z,$xc)){if($_POST["save"]||$_POST["delete"]){$I=true;$ua=0;$P=array();if(!$_POST["delete"]){foreach($g
as$C=>$X){$X=process_input($r[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$P[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$P){if($_POST["clone"])$H="INTO ".table($a)." (".implode(", ",array_keys($P)).")\nSELECT ".implode(", ",$P)."\nFROM ".table($a);if($_POST["all"]||($Ie&&is_array($_POST["check"]))||$kd){$I=($_POST["delete"]?$o->delete($a,$Zg):($_POST["clone"]?queries("INSERT $H$Zg"):$o->update($a,$P,$Zg)));$ua=$i->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Vg="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$r);$I=($_POST["delete"]?$o->delete($a,$Vg,1):($_POST["clone"]?queries("INSERT".limit1($a,$H,$Vg)):$o->update($a,$P,$Vg,1)));if(!$I)break;$ua+=$i->affected_rows;}}}$Qd=lang(80,$ua);if($_POST["clone"]&&$I&&$ua==1){$yd=last_id();if($yd)$Qd=lang(79," $yd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Qd,$I);if(!$_POST["delete"]){edit_form($a,$r,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$p=lang(81);else{$I=true;$ua=0;foreach($_POST["val"]as$Dg=>$K){$P=array();foreach($K
as$z=>$X){$z=bracket_escape($z,1);$P[idf_escape($z)]=(preg_match('~char|text~',$r[$z]["type"])||$X!=""?$b->processInput($r[$z],$X):"NULL");}$I=$o->update($a,$P," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Dg,$r),!$kd&&!$Ie," ");if(!$I)break;$ua+=$i->affected_rows;}queries_redirect(remove_from_uri(),lang(80,$ua),$I);}}elseif(!is_string($kc=get_file("csv_file",true)))$p=upload_error($kc);elseif(!preg_match('~~u',$kc))$p=lang(82);else{cookie("adminer_import","output=".urlencode($ta["output"])."&format=".urlencode($_POST["separator"]));$I=true;$fb=array_keys($r);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$kc,$Kd);$ua=count($Kd[0]);$o->begin();$N=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$L=array();foreach($Kd[0]as$z=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$N]*)$N~",$X.$N,$Ld);if(!$z&&!array_diff($Ld[1],$fb)){$fb=$Ld[1];$ua--;}else{$P=array();foreach($Ld[1]as$t=>$cb)$P[idf_escape($fb[$t])]=($cb==""&&$r[$fb[$t]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$cb))));$L[]=$P;}}$I=(!$L||$o->insertUpdate($a,$L,$Ie));if($I)$I=$o->commit();queries_redirect(remove_from_uri("page"),lang(83,$ua),$I);$o->rollback();}}}$Xf=$b->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(46).": $Xf",$p);$P=null;if(isset($jf["insert"])||!support("table")){$P="";foreach((array)$_GET["where"]as$X){if($xc[$X["col"]]&&count($xc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$P.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($S,$P);if(!$g&&support("table"))echo"<p class='error'>".lang(84).($r?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($M,$g);$b->selectSearchPrint($Z,$g,$x);$b->selectOrderPrint($pe,$g,$x);$b->selectLimitPrint($_);$b->selectLengthPrint($dg);$b->selectActionPrint($x);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$zc=$i->result(count_rows($a,$Z,$kd,$Dc));$E=floor(max(0,$zc-1)/$_);}$qf=$M;$Ec=$Dc;if(!$qf){$qf[]="*";$mb=convert_fields($g,$r,$M);if($mb)$qf[]=substr($mb,2);}foreach($M
as$z=>$X){$q=$r[idf_unescape($X)];if($q&&($_a=convert_field($q)))$qf[$z]="$_a AS $X";}if(!$kd&&$Fg){foreach($Fg
as$z=>$X){$qf[]=idf_escape($z);if($Ec)$Ec[]=idf_escape($z);}}$I=$o->select($a,$qf,$Z,$Ec,$pe,$_,$E,true);if(!$I)echo"<p class='error'>".error()."\n";else{if($y=="mssql"&&$E)$I->seek($_*$E);$Pb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$L=array();while($K=$I->fetch_assoc()){if($E&&$y=="oracle")unset($K["RNUM"]);if($E&&$y=="mssql")unset($K["SSMA_TimeStamp"]);$L[]=$K;}if($_GET["page"]!="last"&&$_!=""&&$Dc&&$kd&&$y=="sql")$zc=$i->result(" SELECT FOUND_ROWS()");if(!$L)echo"<p class='message'>".lang(12)."\n";else{$Ka=$b->backwardKeys($a,$Xf);echo"<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Dc&&$M?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(85)."</a>");$Yd=array();$Cc=array();reset($M);$Ue=1;foreach($L[0]as$z=>$X){if(!isset($Fg[$z])){$X=$_GET["columns"][key($M)];$q=$r[$M?($X?$X["col"]:current($M)):$z];$C=($q?$b->fieldName($q,$Ue):($X["fun"]?"*":$z));if($C!=""){$Ue++;$Yd[$z]=$C;$f=idf_escape($z);$Rc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($z);$zb="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Rc.($pe[0]==$f||$pe[0]==$z||(!$pe&&$kd&&$Dc[0]==$f)?$zb:'')).'">';echo
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Rc.$zb)."' title='".lang(86)."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(41).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($z)."');");}echo"</span>";}$Cc[$z]=$X["fun"];next($M);}}$Ad=array();if($_GET["modify"]){foreach($L
as$K){foreach($K
as$z=>$X)$Ad[$z]=max($Ad[$z],min(40,strlen(utf8_decode($X))));}}echo($Ka?"<th>".lang(87):"")."</thead>\n";if(is_ajax()){if($_%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($L,$xc)as$Xd=>$K){$Cg=unique_array($L[$Xd],$x);if(!$Cg){$Cg=array();foreach($L[$Xd]as$z=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$z))$Cg[$z]=$X;}}$Dg="";foreach($Cg
as$z=>$X){if(($y=="sql"||$y=="pgsql")&&preg_match('~char|text|enum|set~',$r[$z]["type"])&&strlen($X)>64){$z=(strpos($z,'(')?$z:idf_escape($z));$z="MD5(".($y!='sql'||preg_match("~^utf8~",$r[$z]["collation"])?$z:"CONVERT($z USING ".charset($i).")").")";$X=md5($X);}if($y=="mssql"&&$r[$z]["type"]=='timestamp'&&$r[$z]["field"]=='SSMA_TimeStamp')continue;$Dg.="&".($X!==null?urlencode("where[".bracket_escape($z)."]")."=".urlencode($X):"null%5B%5D=".urlencode($z));}echo"<tr".odd().">".(!$Dc&&$M?"":"<td>".checkbox("check[]",substr($Dg,1),in_array(substr($Dg,1),(array)$_POST["check"])).($kd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Dg)."' class='edit'>".lang(88)."</a>"));foreach($K
as$z=>$X){if(isset($Yd[$z])){$q=$r[$z];$X=$o->value($X,$q);if($X!=""&&(!isset($Pb[$z])||$Pb[$z]!=""))$Pb[$z]=(is_mail($X)?$Yd[$z]:"");$A="";if(preg_match('~blob|bytea|raw|file~',$q["type"])&&$X!="")$A=ME.'download='.urlencode($a).'&field='.urlencode($z).$Dg;if(!$A&&$X!==null){foreach((array)$xc[$z]as$wc){if(count($xc[$z])==1||end($wc["source"])==$z){$A="";foreach($wc["source"]as$t=>$Gf)$A.=where_link($t,$wc["target"][$t],$L[$Xd][$Gf]);$A=($wc["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($wc["db"]),ME):ME).'select='.urlencode($wc["table"]).$A;if($wc["ns"])$A=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($wc["ns"]),$A);if(count($wc["source"])==1)break;}}}if($z=="COUNT(*)"){$A=ME."select=".urlencode($a);$t=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Cg))$A.=where_link($t++,$W["col"],$W["val"],$W["op"]);}foreach($Cg
as$nd=>$W)$A.=where_link($t++,$nd,$W);}$X=select_value($X,$A,$q,$dg);$u=h("val[$Dg][".bracket_escape($z)."]");$Y=$_POST["val"][$Dg][bracket_escape($z)];$Lb=!is_array($K[$z])&&is_utf8($X)&&$L[$Xd][$z]==$K[$z]&&!$Cc[$z];$cg=preg_match('~text|lob~',$q["type"]);if(($_GET["modify"]&&$Lb)||$Y!==null){$Hc=h($Y!==null?$Y:$K[$z]);echo"<td>".($cg?"<textarea name='$u' cols='30' rows='".(substr_count($K[$z],"\n")+1)."'>$Hc</textarea>":"<input name='$u' value='$Hc' size='$Ad[$z]'>");}else{$Fd=strpos($X,"<i>...</i>");echo"<td id='$u' data-text='".($Fd?2:($cg?1:0))."'".($Lb?"":" data-warning='".h(lang(89))."'").">$X</td>";}}}if($Ka)echo"<td>";$b->backwardKeysPrint($Ka,$L[$Xd]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n";}if(!is_ajax()){if($L||$E){$Xb=true;if($_GET["page"]!="last"){if($_==""||(count($L)<$_&&($L||!$E)))$zc=($E?$E*$_:0)+count($L);elseif($y!="sql"||!$kd){$zc=($kd?false:found_rows($S,$Z));if($zc<max(1e4,2*($E+1)*$_))$zc=reset(slow_query(count_rows($a,$Z,$kd,$Dc)));else$Xb=false;}}$ve=($_!=""&&($zc===false||$zc>$_||$E));if($ve){echo(($zc===false?count($L)+1:$zc-$E*$_)>$_?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.lang(90).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$_).", '".lang(91)."...');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($L||$E){if($ve){$Md=($zc===false?$E+(count($L)>=$_?2:1):floor(($zc-1)/$_));echo"<fieldset>";if($y!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(92)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(92)."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" ...":"");for($t=max(1,$E-4);$t<min($Md,$E+5);$t++)echo
pagination($t,$E);if($Md>0){echo($E+5<$Md?" ...":""),($Xb&&$zc!==false?pagination($Md,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Md'>".lang(93)."</a>");}}else{echo"<legend>".lang(92)."</legend>",pagination(0,$E).($E>1?" ...":""),($E?pagination($E,$E):""),($Md>$E?pagination($E+1,$E).($Md>$E+1?" ...":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(94)."</legend>";$Db=($Xb?"":"~ ").$zc;echo
checkbox("all",1,0,($zc!==false?($Xb?"":"~ ").lang(95,$zc):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Db' : checked); selectCount('selected2', this.checked || !checked ? '$Db' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(85),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(81).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(96),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(97),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$yc=$b->dumpFormat();foreach((array)$_GET["columns"]as$f){if($f["fun"]){unset($yc['sql']);break;}}if($yc){print_fieldset("export",lang(98)." <span id='selected2'></span>");$te=$b->dumpOutput();echo($te?html_select("output",$te,$ta["output"])." ":""),html_select("format",$yc,$ta["format"])," <input type='submit' name='export' value='".lang(98)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Pb,'strlen'),$g);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(99)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ta["format"],1);echo" <input type='submit' name='import' value='".lang(99)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$og'>\n","</form>\n",(!$Dc&&$M?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$i->query("KILL ".number($_POST["kill"]));elseif(list($R,$u,$C)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$_=11;$I=$i->query("SELECT $u, $C FROM ".table($R)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$u = $_GET[value] OR ":"")."$C LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $_");for($t=1;($K=$I->fetch_row())&&$t<$_;$t++)echo"<a href='".h(ME."edit=".urlencode($R)."&where".urlencode("[".bracket_escape(idf_unescape($u))."]")."=".urlencode($K[0]))."'>".h($K[1])."</a><br>\n";if($K)echo"...\n";}exit;}else{page_header(lang(59),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(100).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(41)."'>\n";if($_POST["query"]!="")search_tables();echo"<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(101),'<td>'.lang(102),"</thead>\n";foreach(table_status()as$R=>$K){$C=$b->tableName($K);if(isset($K["Engine"])&&$C!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$R,in_array($R,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($R)."'>$C</a>";$X=format_number($K["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($R)."'>".($K["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</form>\n",script("tableCheck();");}}page_footer();