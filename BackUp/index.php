<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Entry Form</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        input{
            border: 1px solid #ccc;
            border-radius: 4px;
            line-height: 28px;
            transition: border-color 0.3s ease;
            padding-left: 8px;
            padding-right: 0px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 8px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0097a7;
        }

        input:hover,textarea:hover {
            border-color: #3498db;
        } 
    </style>
</head>
<body>
    <?php include "navBar.php"; ?>
    
    <div class="form-container">
        <form action="index.php" method="post">
            <!-- Date -->
            <label for="dateInput">Date:</label>
            <input type="date" name="dateInput" id="dateInput" value="<?php echo date('Y-m-d'); ?>" required>
   
            <!-- Entry -->
            <label>Checked:  </label>
                <label for="online1">
                    <input type="radio" name="online" value="on" id="online1"/>    
                        On
                </label>
                <label for="offline1">
                     <input type="radio" name="online" value="off" id="offline1"/>
                         Off
                </label><br/><br/>
                <label for="morning">Morning</label>
                    <input type="checkbox" name="morning" id="morning">
                <label for="afternoon">Afternoon</label>
                    <input type="checkbox" name="afternoon" id="afternoon">
                <label for="evening">Evening</label>
                    <input type="checkbox" name="evening" id="evening">
                <label for="night">Night</label>
                    <input type="checkbox" name="night" id="night"><br/><br/>

            
            <!-- Status Desc. -->
            <label for="status">Status:</label>
                <textarea name="status" id="status" cols="30" rows="4" required></textarea>
            <input type="submit" value="Submit">
        </form>
    </div>
    <script>
      
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            var dateInput = $('#dateInput').val();
            var mode = $("input[name='online']:checked").val(); 
            var status = $("#status").val();
            var morning = $("#morning").prop('checked');
            var afternoon = $("#afternoon").prop('checked');
            var evening = $("#evening").prop('checked');
            var night = $("#night").prop('checked');

            $.ajax({
                url: "process.php",
                method: "post",
                data: {
                    action: "save",
                    dateInput: dateInput,
                    mode: mode,
                    status: status,
                    morning: morning,
                    afternoon: afternoon,
                    evening: evening,
                    night: night
                },
                success: function(rep) {
                    console.log(rep);
                    alert(rep);
                },
                error: function(rep) {
                    console.log(rep);
                }
            });
        });
    });
</script>
</body>
</html>
