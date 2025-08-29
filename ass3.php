<?php
$students = [
    ['stdNo'=>'20003','stdName'=>'Ahmed Ali','stdEmail'=>'ahmed@gmail.com','stdGAP'=>88.7],
    ['stdNo'=>'30304','stdName'=>'Mona Khalid','stdEmail'=>'mona@gmail.com','stdGAP'=>78.5],
    ['stdNo'=>'10002','stdName'=>'Bilal Hmaza','stdEmail'=>'bilal@gmail.com','stdGAP'=>98.7],
    ['stdNo'=>'10005','stdName'=>'Said Ali','stdEmail'=>'said@gmail.com','stdGAP'=>98.7],
    ['stdNo'=>'10007','stdName'=>'Mohammed Ahmed','stdEmail'=>'mohamed@gmail.com','stdGAP'=>98.7],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-4">

<h3 class="text-center mb-3">Students Data</h3>

<div class="mb-2 d-flex justify-content-between">
  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Student</button>
  <button class="btn btn-danger" id="deleteBtn" disabled>Delete Selected</button>
</div>

<table class="table table-bordered table-hover" id="table">
  <thead class="table-dark">
    <tr>
      <th><input type="checkbox" id="checkAll"></th>
      <th>#</th>
      <th>Student No</th>
      <th>Name</th>
      <th>Email</th>
      <th>GPA</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1; 
       foreach($students as $user ){?>
        <tr>
        <td>
            <input type="checkbox" class="rowCheck">
        <td>
            <?php echo $i++;?>
        </td> 
         <td>
            <?php echo $user['stdNo']; ?>
        </td>
        <td>
            <?php echo $user['stdName']; ?>
        </td>
        <td>
            <?php echo $user['stdEmail']; ?>
        </td>
         <td>
            <?php echo $user['stdGAP']; ?>
        </td>
        </tr>
      <?php } ?>
  </tbody>
</table>

<div class="alert alert-info text-center" id="count">Student count: <?= count($students) ?></div>

<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <form id="form" class="modal-content">
      <div class="modal-header"><h5>Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input id="no" class="form-control mb-2" placeholder="Student No" required>
        <input id="name" class="form-control mb-2" placeholder="Name" required>
        <input id="email" type="email" class="form-control mb-2" placeholder="Email" required>
        <input id="gpa" type="number" step="0.01" class="form-control" placeholder="GPA" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
let tbody=document.querySelector("#table tbody"),
    count=document.getElementById("count"),
    checkAll=document.getElementById("checkAll"),
    delBtn=document.getElementById("deleteBtn"),
    form=document.getElementById("form");

function update(){
  [...tbody.rows].forEach((r,i)=>r.cells[1].textContent=i+1);
  count.textContent="Student count: "+tbody.rows.length;
  delBtn.disabled=![...tbody.querySelectorAll(".rowCheck")].some(c=>c.checked);
}

checkAll.onchange=()=>[...tbody.querySelectorAll(".rowCheck")].forEach(c=>c.checked=checkAll.checked),update();
tbody.onchange=update;

delBtn.onclick=()=>{[...tbody.querySelectorAll(".rowCheck:checked")].forEach(c=>c.closest("tr").remove());checkAll.checked=false;update();}

form.onsubmit=e=>{
  e.preventDefault();
  let r=tbody.insertRow();
  r.innerHTML=`<td><input type="checkbox" class="rowCheck"></td>
               <td></td>
               <td>${no.value}</td><td>${name.value}</td>
               <td>${email.value}</td><td>${gpa.value}</td>`;
  update(); form.reset(); bootstrap.Modal.getInstance(addModal).hide();
}
</script>
</body>
</html>
