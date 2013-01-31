<?php
include 'all_function.php';

if(isset($_POST['CYCLE_ID']))
{
$cycle =securite_bdd($_POST['CYCLE_ID']);
echo'<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Liste des Disciplines *</B><select name="uv" id="uv" onchange="go1()" required>
<OPTION value=""></OPTION>';

				 $table = 'disciplines';
				 $lib = 'cycle';
				 $selection = findByNValue($table,"cycle='$cycle'");
				
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".utf8_encode($ro[1])."</option>";
    			}
				echo'
					</select></TD>';
				
}

?>