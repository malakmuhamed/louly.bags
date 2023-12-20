<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>
    
    
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                   <img src="imgs/loulylogo.png">
                </div>
                <div class="close" id="close-button">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
               <a href="#" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
                <a href="homee.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Home Page</h3>
               </a> 
               <a href="search.php">
                <span class="material-icons-sharp">person</span>
                <h3>Users Accounts</h3>
               </a> 
               <a href="#">
                <span class="material-icons-sharp">person</span>
                <h3>Admin Accounts</h3>
               </a> 
               <a href="admin_addproduct.php">
                <span class="material-icons-sharp">receipt_long</span>
                <h3>Add product</h3>
               </a> 
               <a href="deleteproduct.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Edit Product</h3>
               </a> 
               <a href="deleteproduct.php">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Delete product</h3>
                
               </a> 
               <a href="permissions.php">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Manage user roles</h3>
                
               </a> 
               <a href="vieworders.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Orders</h3>
               </a> 
               <a href="Account.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Log out</h3>
               </a> 
               
            </div>
           
        </aside>

                                <!------------- End Of Sidebar -------------> 



        <main>
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="sales">
                <span class="material-icons-sharp">analytics</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Sales</h3>
                        <p>$25,024 </p>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                            <p>88%</p>
                        </div>
                        
                    </div>
                </div>
                <small class="text-muted">Last 24 hours</small>
            </div>
            

                                    <!------------- End Of Sales -------------> 

            <div class="Expenses">
                <span class="material-icons-sharp">equalizer</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Expenses</h3>
                        <p>$12,024 </p>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                            <p>64%</p>
                        </div>
                        
                    </div>
                </div>
                <small class="text-muted">Last 24 hours</small>
            </div>
            

                                    <!------------- End Of Expenses -------------> 


            <div class="Income">
                <span class="material-icons-sharp">stacked_line_chart</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Income</h3>
                        <p>$13,000 </p>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                            <p>46%</p>
                        </div>
                        
                    </div>
                </div>
                <small class="text-muted">Last 24 hours</small>
            </div>
            
                                    <!------------- End Of Income -------------> 

            </div>
                                    <!------------- End Of Insights -------------> 

            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>cross bag</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>rounded bag</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>shoulder bag</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>hand bag</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>




        </main>

                                    <!------------- End Of Main -------------> 


        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>  
                <div class="admin">
                    <div class="profile">
                        <div class="info">
                            <p>Hey, Admin</p>
                            <!-- <small class="text-muted">Admin</small> -->
                        </div>
                        <div class="profile-photo">
                            <img src="imgs/usericon.jpg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
                                    
                                    <!------------- End Of Top -------------> 


            <div class="recent-updates">
                <div class="updates">
                    <h2>Order-Details</h2>
                        <div class="update">
                        <div class="profile-photo">
                            <img src="imgs/usericon.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Areej Ahmed </b> recieved her order of Night lion tech GPS drone.</p>
                            <small class="text-muted">3 Minutes ago</small>
                        </div>
                        </div>
                        <div class="update">
                        <div class="profile-photo">
                            <img src="imgs/usericon.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Shahd Tamer </b> declined her order of 2 DJI Air 2S.</p>
                            <small class="text-muted">5 Minutes ago</small>
                        </div>
                        </div>
                        <div class="update">
                        <div class="profile-photo">
                            <img src="imgs/usericon.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>shahd Ibrahim </b> recieved her order of LARVENDER KF102 Drone.</p>
                            <small class="text-muted">1 Minute ago</small>
                        </div>
                        </div>
                        <!-- <div class="update">
                        <div class="profile-photo">
                            <img src="Malak.png" alt="">
                        </div>
                        <div class="message">
                            <p><b>Malak Helal </b> recieved her order of Night lion tech GPS drone.</p>
                            <small class="text-muted">3 Minutes ago</small>
                        </div>
                    </div> -->
                </div>
                
            </div>
                

                                                <!------------- End Of Recent Updates -------------> 

            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                <div class="icon">
                    <span class="material-icons-sharp">shopping_cart</span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ONLINE ORDERS</h3>
                        <small class="text-muted">Last 24 hours</small>
                    </div>
                    <h5 class="success">+39%</h5>
                    <h3>3849</h3>
                    
                </div>
                </div>

                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>OFFLINE ORDERS</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                        
                    </div>
                    </div>

                    <div class="item customers">
                        <div class="icon">
                            <span class="material-icons-sharp">person</span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>NEW CUSTOMERS</h3>
                                <small class="text-muted">Last 24 hours</small>
                            </div>
                            <h5 class="success">+25%</h5>
                            <h3>849</h3>
                            
                        </div>
                    </div>
                    
                    <div class="item add-product">
                            <span class="material-icons-sharp">add</span>
                            <h3>Add Product</h3>
                    </div>
            </div>
                    
                    
        </div>
            
    
    </div>





</body>
<script src="Dashboard.js"></script>

</html>