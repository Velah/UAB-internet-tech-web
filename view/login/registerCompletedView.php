<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link rel="stylesheet" type="text/css" href="../css/registerCompleted.css">
    <script type="text/javascript" src="../js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../js/landing.js" defer></script>
    <script type="text/javascript" src="../js/list.js" defer></script>
</head>

<body>
    <div>
        <?php if($completed){
                echo "<p>Registre completat</p>
                      <a href='../index.php'>Fes click aquí per tornar a l'inici</a>";
              }
              else{
                  echo "<p>El registre no s'ha pogut completar</p>
                      <a href='../index.php'>Fes click aquí per tornar a l'inici</a>";
              }
        ?>
    </div>


</body>