<!DOCTYPE html>
<html>
<head>
    <title>Code Challenge</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body
        {
            padding:20px;
            margin:20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Event Data Filtering </h2>
        <div class="col-12">
            <form method="Get">
                <label>Employee Name: </label>
                <p><input type="text" name="employee_name"></p>
                <label>Event Name: </label>
                <p><input type="text" name="event_name"></p>
                <label>Event Date: </label>
                <p><input type="text" name="event_date"></p>
                <input type="submit" value="search">
            </form>
        </div>
        <br /><br />
        <?php

        //Code for Displaying Data

        echo('<div class="col-12 m-10" >');
        echo('<table class="table table-borderless m-4"  >');
        echo('<thead class="thead-light ">');
        echo('<tr><th>Participation Id</th>');
        echo('<th>Employee Name</th>');
        echo('<th>Employee Email</th>');
        echo('<th>Event Name</th>');
        echo('<th>Participation Fee</th>');
        echo('<th>Event Date</th></tr>');
        echo('</thead>');

        if (!empty($events)) {
            $totalFees=0;
            foreach ($events as $event) {

                echo "<tr><td>";
                echo(htmlentities($event['participation_id']));
                echo("</td><td>");
                echo(htmlentities($event['employee_name']));
                echo("</td><td>");
                echo(htmlentities($event['employee_mail']));
                echo("</td><td>");
                echo(htmlentities($event['event_name']));
                echo("</td><td>");
                echo(htmlentities($event['participation_fee']));
                echo("</td><td>");
                echo(htmlentities($event['event_date']));
                echo("</td>");
                echo("</tr>");
                $totalFees += $event['participation_fee'];

            }
            echo("<tr><td colspan='4'> <b>Total Fee </b></td>");
            echo("<td colspan='2'>" . $totalFees . "</td></tr>");
        } else {
            echo("<tr><td colspan='6'> <b>Data not found. </b></td>");
        }
        echo("</table>");
        echo('</div>');
        ?>
    </div>
</div>
</body>