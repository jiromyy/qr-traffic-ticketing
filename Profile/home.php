<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
   
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>
    <title>View Profile</title>
</head>
<body>
    <?php include('../php/get_profile.php');
        include('../php/get_violation.php')
    ?>
    
    <div class="wrapper">
        <div class="sidebar">
            <div class="profile">
                <!-- make the image responsive -->
                <img src="../images/<?php echo $fname ?>.jpg" alt="user-image">
                <h3 class="heading-tertiary"><?php echo $fname . " " . $lname?> </h3>
                <p>Client</p>
            </div>
            <ul>
                <li class="selectedLink" name="profile">
                    <a href="#" class="active">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="item">View Profile</span>
                    </a>
                </li>
                <li name="violations">
                    <a href="#">
                        <span class="icon"><ion-icon name="ticket-outline"></ion-icon></span>
                        <span class="item">View Violations</span>
                    </a>
                </li>
                <li name="qr">
                    <a href="#">
                        <span class="icon"><ion-icon name="qr-code-outline"></ion-icon></span>
                        <span class="item">Show QR Code</span>
                    </a>
                </li>
            </ul>
            <form id="logout" method="post">
            <ion-icon name="log-out-outline"></ion-icon>
                    <button type="submit" name="logout" class="btn btn--logout">
                    <ion-icon name="log-out-outline"></ion-icon>
                        Logout
                    </button>
            </form>
        </div>
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <ion-icon name="filter-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="card active home" data-profile>
                <div class="title-user">User Information</div>
                <div class="content">
                    <form action="">
                        <div class="user-details">
                            <div class="input-box-width">
                                <span class="details">Client Number</span>
                                <input type="text" value="<?php echo $username?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">Last Name</span>
                                <input type="text" value="<?php echo $lname?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">First Name</span>
                                <input type="text" value="<?php echo $fname?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="title-user">General Information</div>
                <div class="content">
                    <form action="">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Nationality</span>
                                <input type="text" value="<?php echo $nationality?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">Civil Status</span>
                                <input type="text" value="<?php echo $civilstatus?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">Date of Birth</span>
                                <input type="text" value="<?php echo $dob?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">Place of Birth</span>
                                <input type="text" value="<?php echo $pob?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">Educational Attainment</span>
                                <input type="text" value="<?php echo $educ?>" readonly>
                            </div>
                            <div class="input-box">
                                <span class="details">TIN</span>
                                <input type="text" value="<?php echo $tin?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card violations" data-violations>
                <div class="title-user">Violations</div>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Ticket No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Violations</th>
                            <th scope="col">Issuer</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($result)==0){ ?>
                        <tr>  
                            <td colspan='5'><h2>-- No Records --</h2></td>
                            
                        </tr>  
                            <?php } ?>
                        
                        <?php    
                        while($row = mysqli_fetch_assoc($result)){
                        $ticketID = $row['ticketID'];
                        $date = $row['date'];
                        $violation = $row['violation'];
                        $enforcerf = $row['fname'];
                        $enforcerl = $row['lname'];
                        $status = $row['status'];
                        ?>
                        <tr>
                            <td data-label="Ticket No."><?php echo $ticketID?></td>
                            <td data-label="Date"><?php echo $date?></td>
                            <td data-label="Violation"><?php echo $violation?></td>
                            <td data-label="Issuer"><?php echo $enforcerf . " " . $enforcerl?></td>
                            <td data-label="Status"><?php if($status=="Unsettled"){?>
                                                            <span style="color:red"> <?php  echo $status; ?></span>
                                                    <?php } 
                                                    
                                                    else{?>
                                                            <span style="color:green"> <?php  echo $status; ?></span>
                                                            <?php }?>
                                                                </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card qr" data-qr>
                <!-- <div class="title">QR code</div> -->
                <div class="content content-center">
                    <img class="qr-center" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo $username?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <script src="./card.js"></script>
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function(){
          document.querySelector("body").classList.toggle("active");
        })
      </script>
</body>
</html>