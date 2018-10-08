<!DOCTYPE HTML>  
<html>
    <head>
    </head>
    <style>
        #tabelaImpostos {
            font-family: calibri, sans-serif;
            border-collapse: collapse;
            /*            width: 100%;*/
        }
        td, th {
            border: 3px solid #dddddd;
            text-align: left;
            padding: 5px;
        }
        tr:nth-child(even) {
            background-color: #dfdbf9;
        }
        
        .output{
            color: green;
        }
    </style>
    <body>  
        <div>
            <?php
            function arredonda($input) {
                return round($input * 100) / 100;
            }
	    $periodo = "";
	    $salario = "";
            $sbrutototal = "";
            $ferias = "";
            $feriastotal = "";
            $sbrutototalferias = "";
            $fgtsmensal = "";
            $fgtsperiodo = "";
            $correcaoperiodo = "";
            $fgtstotal = "";
            $salariototalfgts ="";
            ?>

            <form method="post" action="">  
                <h2>Calculo FGTS sobre periodo</h2>
                Periodo: <input type="text" name="periodo" value="">
                <br><br>
                Salario: <input type="text" name="salario" value="">
                <br><br>
                <input type="submit" name="submit" value="Calcular">  
            </form>


            <?php
            $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : "";
            if (!empty($periodo)) {
                ?>
                <h2> O FGTS recebido no periodo de <?php echo $periodo ?> ano(s), e de: </h2>
                <?php
            }
            $salario = isset($_POST['salario']) ? $_POST['salario'] : "";
            if (!empty($salario)) {
                $sbrutototal = arredonda(13 * $salario * $periodo);
		        $ferias = arredonda(($salario/3) + $salario);
		        $feriastotal = arredonda((($salario/3) + $salario) * $periodo);
		        $sbrutototalferias = $sbrutototal + $feriastotal;
                $fgtsmensal = arredonda(0.08 * $salario);
		        $fgtsperiodo = arredonda($sbrutototalferias * 0.08);
		        $correcaoperiodo = arredonda($fgtsperiodo * 0.036);
		        $fgtstotal = arredonda($fgtsperiodo + $correcaoperiodo);
		        $salariototalfgts = arredonda($fgtstotal + $sbrutototalferias);
            }
            ?>

        </div>
        <div>
            <table id="tabelaImpostos">
                <title></title>
                <tr>
                    <th>Salario Bruto</th> 
                    <th>R$ <?php echo $salario; ?> </th>
                </tr>
                <tr>
                    <td>Salario Bruto total no periodo:</td>
                    <td class="output"><?php echo $sbrutototal; ?></td>
                </tr>
                <tr>
                    <td>Ferias totais no periodo:</td>
                    <td class="output"><?php echo $feriastotal; ?></td>
                </tr>
                <tr>
                    <td>Salario Bruto total mais Ferias no periodo</td>
                    <td class="output"><?php echo $sbrutototalferias; ?></td>
                </tr>
                <tr>
                    <td>FGTS mensal</td>
                    <td class="output"><?php echo $fgtsmensal; ?></td>
                </tr>
                <tr>
                    <td>FGTS sobre Salario Bruto total mais Ferias no periodo</td>
                    <td class="output"><?php echo $fgtsperiodo; ?></td>
                </tr>
                <tr>
                    <td>Correcao total no periodo</td>
                    <td class="output"><?php echo $correcaoperiodo; ?></td>                
                </tr>
                <tr>
                    <td>Resultado FGTS total</td>
                    <td class="output"><?php echo $fgtstotal; ?></td>                
                </tr>
                <tr>
                    <td>Resultado Salario total com FGTS + Juros</td>
                    <td class="output"><?php echo $salariototalfgts; ?></td>                
                </tr>
                
                <tr>
          
            </table>
        </div>
    </body>
</html>