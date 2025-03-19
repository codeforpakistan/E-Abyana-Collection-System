@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crop Survey Table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f6fa;
    }

    .sidebar {
      background-color: #112d53;
      color: #fff;
      width: 250px;
      height: 100vh;
      position: fixed;
      padding: 20px;
    }

    .sidebar h2 {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 10px 0;
    }

    .sidebar ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 14px;
    }

    .content {
      margin-left: 270px;
      padding: 20px;
    }

    .content h1 {
      font-size: 24px;
      color: #112d53;
      margin-bottom: 20px;
    }

    .table-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }

    table th {
      background-color: #112d53;
      color: #fff;
    }

    table th[colspan] {
      background-color: #1a4276;
      font-size: 16px;
    }

    table th[rowspan] {
      vertical-align: middle;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 5px;
    }

    .btn {
      padding: 5px 10px;
      font-size: 12px;
      border-radius: 4px;
      color: #fff;
      text-decoration: none;
    }

    .btn-view {
      background-color: #28a745;
    }

    .btn-edit {
      background-color: #007bff;
    }

    .btn-delete {
      background-color: #dc3545;
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .pagination span, .pagination a {
      padding: 5px 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      color: #112d53;
      text-decoration: none;
    }

    .pagination span {
      background-color: #112d53;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Abyana</h2>
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Add Division</a></li>
      <li><a href="#">Add District</a></li>
      <li><a href="#">Add Tehsil</a></li>
      <li><a href="#">Add Village</a></li>
      <li><a href="#">Add Canal</a></li>
      <li><a href="#">Add Outlet</a></li>
      <li><a href="#">Add Halqa</a></li>
      <li><a href="#">Add Crop</a></li>
    </ul>
  </div>

  <div class="content">
    <h1>Crop Survey / فصل کی تفصیلات</h1>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th rowspan="2">ID</th>
            <th colspan="3">Crop Type Registration</th>
            <th rowspan="2">Sowing Date</th>
            <th colspan="2">Final Measurement</th>
            <th rowspan="2">Area (Kanal)</th>
            <th rowspan="2">Action</th>
          </tr>
          <tr>
            <th>Marla</th>
            <th>Kanal</th>
            <th>Previous Crop Name</th>
            <th>Length (m)</th>
            <th>Width (m)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>60</td>
            <td>3</td>
            <td>Rice</td>
            <td>16-12-2024</td>
            <td>90</td>
            <td>60</td>
            <td>5</td>
            <td class="action-buttons">
              <a href="#" class="btn btn-view">View</a>
              <a href="#" class="btn btn-edit">Edit</a>
              <a href="#" class="btn btn-delete">Delete</a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>80</td>
            <td>6.5</td>
            <td>Rice</td>
            <td>09-08-2024</td>
            <td>50</td>
            <td>15</td>
            <td>2.75</td>
            <td class="action-buttons">
              <a href="#" class="btn btn-view">View</a>
              <a href="#" class="btn btn-edit">Edit</a>



              
 @endsection
 