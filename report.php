<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            margin: 10px;
        }

        .container {
            margin: 20px;
            padding: 20px;
        }

        table.dataTable{
            padding-top: 10px;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <!-- Include jQuery and DataTables CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.js"></script>
</head>

<body>
        <?php include "navBar.php"; require "config.php";?>
    <header>
        <h2>Report Table</h2>
    </header>
    
    <div class="container">
        <table id="reportTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Date</th>
                    <th>Checked</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($con, "select * from report ORDER BY date DESC");
                while ($result = mysqli_fetch_assoc($query)) {
                    echo "<tr><td>" . $result['date'] . "</td>";
                    echo "<td>" . date('d-M-y', strtotime($result['date'])) . "</td>";
                    echo "<td>" . ($result['mode'] == 'off' ? 'No' : 'Yes') . "</td>";
                    echo "<td>" . $result['status'] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTable
        $(document).ready(function () {
            $('#reportTable').DataTable({
                //~ Initial sorting based on the hidden column
                columnDefs: [
                    { 
                        targets: [0], 
                        visible: false, 
                        searchable: false 
                    },
                ],
                order: [[0, 'desc']]
            });
        });
    </script>
</body>

</html>
