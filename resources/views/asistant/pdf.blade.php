<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    
    <style type="text/css">
      *{
        text-align: center;
      }
    </style>
  </head>
  <body>
    
     <h2><strong>Presentation:</strong>  {{$presentation->tittle}}</h2>
     <h2><strong>Name:</strong>  {{$user->first_name}}</h2>
     <h2><strong>Last Name:</strong>  {{$user->last_name}}</h2>
     <h2><strong>Email:</strong>  {{$user->email}}</h2>
     <h2><strong>Phone:</strong>  {{$user->phone}}</h2>
     <h2><strong>Credit Card:</strong>  {{$user->card}}</h2>
    
    <h3>Congress Online</h3>
  </body>
</html>
