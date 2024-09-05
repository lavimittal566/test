<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Interface</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 50px auto;
    background: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.add-btn {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-btn:hover {
    background-color: #218838;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f8f9fa;
    color: #333;
}

table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.edit-btn, .delete-btn {
    padding: 8px 12px;
    margin-right: 5px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.edit-btn {
    background-color: #007bff;
    color: white;
}

.edit-btn:hover {
    background-color: #0069d9;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}

.delete-btn:hover {
    background-color: #c82333;
}

        </style>
</head>
<body>
    <div class="container">
        <h1>List</h1>
       <a href="{{ url()->previous() }}"><button type="submit" class="add-btn">Back</button></a>
       <a href="{{ url('get-all-list') }}"><button type="submit" class="add-btn">Show all task button</button></a>

       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tasksTable">
                @foreach($tasks as $task)
                <?php if($task->status == '1'){
              $status = 'completed'; 
            }else{
                $status = "Non completed";
            }
              ?>
                <tr id="{{$task->id}}">
                    <td>{{$task->id}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$status}}</td>
                    <td>
                        <button class="deleteTask" id="{{$task->id}}">Delete</button>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#taskForm').on('submit', function(e) {
            e.preventDefault();
            let task = $('#taskInput').val();

            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "store",
                type: "POST",
                data: {
                    task: task,
                    _token: _token
                },
                success: function(response) {
                    $('#tasksTable').append(response.html);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>

<script>

$(document).on('click', '.deleteTask', function(e) {
    e.preventDefault();

   let taskId = $(this).attr('id');
    let _token = $('input[name=_token]').val();
    if (confirm('Are you sure you want to delete this task?')) {
        $.ajax({
            url: `tasks/${taskId}`,
            method: "DELETE",
            data: { _token: _token },
            success: function(response) {
                if(response.status == "success") {
                    $(`#${taskId}`).remove();
                } else {
                    alert('Unable to delete task');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    }
});

</script>

