<div class="container">
    <h2>Lista de montos exitentes</h2>
    <?php

    echo "<table>
        <tr>
        <th>Nro. Cuenta</th>
        <th>La Paz</th>
        <th>Oruro</th>
        <th>Potosí</th>
        <th>Chuquisaca</th>
        <th>Tarija</th>
        <th>Santa Cruz</th>
        <th>Beni</th>
        <th>Pando</th>
        </tr>";

    foreach ($dato as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['nro_cuenta'] . "</td>";
        echo "<td>" . $fila['La Paz'] . "</td>";
        echo "<td>" . $fila['Oruro'] . "</td>";
        echo "<td>" . $fila['Potosí'] . "</td>";
        echo "<td>" . $fila['Chuquisaca'] . "</td>";
        echo "<td>" . $fila['Tarija'] . "</td>";
        echo "<td>" . $fila['Santa Cruz'] . "</td>";
        echo "<td>" . $fila['Beni'] . "</td>";
        echo "<td>" . $fila['Pando'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>


    <h2>Totales</h2>
    <table>
        <tr>
            <th>La Paz</th>
            <th>Oruro</th>
            <th>Potosí</th>
            <th>Chuquisaca</th>
            <th>Tarija</th>
            <th>Santa Cruz</th>
            <th>Beni</th>
            <th>Pando</th>
        </tr>
        <tr>
            <td><?php echo $total['La Paz'] ?></td>
            <td><?php echo $total['Oruro'] ?></td>
            <td><?php echo $total['Potosí'] ?></td>
            <td><?php echo $total['Chuquisaca'] ?></td>
            <td><?php echo $total['Tarija'] ?></td>
            <td><?php echo $total['Santa Cruz'] ?></td>
            <td><?php echo $total['Beni'] ?></td>
            <td><?php echo $total['Pando'] ?></td>
        </tr>
    </table>
</div>

<style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 80%;
        margin: auto;
    }

    h2 {
        color: #333;
    }

    /* Estilos para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    /* Estilos para el botón */
    .btn-agregar {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-agregar:hover {
        background-color: #45a049;
    }

    /* Estilos para los formularios dentro de las celdas de la tabla */
    .form-inline {
        display: inline-block;
    }

    /* Estilos para los botones dentro de las celdas de la tabla */
    .btn-table {
        background-color: #f44336;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        border-radius: 3px;
    }

    .btn-table:hover {
        background-color: #d32f2f;
    }
</style>