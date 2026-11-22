<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-4">
  <h2>Ticket</h2>
  <div class="mb-3">
    <form id="createUserForm">

      <button type="submit" class="btn btn-primary">Add ticket</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-striped" id="usersTable">
      <thead>
        <tr>
          <th>ticket id</th>
          <th>ticket code</th>
          <th>reporter name</th>
          <th>issue title</th>
          <th>priority</th>
          <th>status</th>
          <th>assigned technician id</th>
          <th>parent ticket</th>
          <th>created at</th>
          <th>updated at</th>
          <th>deleted at</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr><td colspan="3">Loading...</td></tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>