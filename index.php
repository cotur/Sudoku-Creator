<?php
/**
 * Created by PhpStorm.
 * User: ahmet
 * Date: 3.03.2018
 * Time: 16:04
 */

include_once "Sudoku.php";

$sudokuTable = new Sudoku();

?>
<html>
    <head>
        <title>Sudoku</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $(".cell").mouseover(function () {
                    var dataValue = $(this).attr("data");
                    $('td[data='+dataValue+']').css("background-color","#dfdfdf");
                }).mouseout(function () {
                    var dataValue = $(this).attr("data");
                    $('td[data='+dataValue+']').css("background-color","white");
                });

            });
        </script>
    </head>
    <body>
        <table align="center" cellspacing="0" cellpadding="9" border="1">
            <?php
                for($y = 0; $y <= 8; $y++){
                    echo '<tr>';
                        for($x = 0; $x <= 8; $x++){
                            echo '<td  class="cell" style="'.($y == 2 || $y == 5 ? "border-bottom:2px solid black;":null).($x == 2 || $x == 5 ? "border-right:2px solid black":null).'" align="center" data="'.$sudokuTable->SudokuTable[$y][$x].'">'.$sudokuTable->SudokuTable[$y][$x].'</td>';
                        }
                    echo'</tr>';
                }
            ?>
        </table>
    </body>
</html>
