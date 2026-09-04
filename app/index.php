<?php require_once('header.php'); ?>
<?php require_once('menu.php'); ?>
<div class="content p-4">
		<div class="mb-4">
        <h1 class="mb-4 text-center">Dashboard [<?php echo $_SESSION['user_name']; ?>] <span class='badge badge-success'> SMS : <?php print_r(get_bal_sms()); ?></span> </h1>

    <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-primary text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-user"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Advisor</p>
                    <h3 class="font-weight-bold mb-0"><?php  echo get_all('member','*', array('user_type'=>'ADVISOR'))['count'];?></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-success text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-male"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Member</p>
                    <a href='manage_member'> <h3 class="font-weight-bold mb-0" ><?php  echo get_all('member')['count'];?></h3></a>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-danger text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-list"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Products</p>
                    <a href='manage_product'> <h3 class="font-weight-bold mb-0"><?php  echo get_all('product')['count'];?></h3> </a>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="d-flex border">
                <div class="bg-info text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">SMS</p>
                    <a href='sms_report'><h3 class="font-weight-bold mb-0"><?php  echo get_all('sms_log')['count'];?></h3></a>
                </div>
            </div>
        </div>
    </div>
    <div class='section mb-3'>
       
        <div class='row'>
        <div class='col-md-6'>
        <div class='card'>
                <div class='card-header'> Last 10 Day Transcation 
                    <a href='collection_report' class='btn btn-primary btn-sm float-right'> Show All</a>
                    
                </div>
                    <div class='card-body'>
                    <table class='table'>
                        <tr>
                            <td>Discription</td>
                            <td>Cash</td>
                            <td>Bank</td>
                            <td align='right'>Wallet</td>
                        </tr>
                        <?php 
                        $sql ="SELECT invoice_date, sum(cash) as cash , sum(bank) as bank , sum(wallet) as wallet FROM `invoice` group by invoice_date order by invoice_date desc limit 10 ";
                        $res = direct_sql($sql);
                        foreach($res['data'] as $row)
                        {
                            echo "<tr>";
                            echo "<td>". date('d-M-Y',strtotime($row['invoice_date']))."</td>";
                            echo "<td>". $row['cash']."</td>";
                            echo "<td>". $row['bank']."</td>";
                            echo "<td align='right'>". $row['wallet']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    </div>
                </div>
        </div>
        
         <div class='col-md-6'>
        <div class='card'>
                <div class='card-header'> Recently Joined Member 
                    <a href='manage_member' class='btn btn-primary btn-sm float-right'> Show All</a>
                    
                </div>
                    <div class='card-body'>
                    <table class='table'>
                        <tr>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Mobile</td>
                            <td align='right'>Wallet</td>
                        </tr>
                        <?php 
                        $sql ="SELECT * from member where mobile <> '' order by id desc limit 10 ";
                        $res = direct_sql($sql);
                        foreach($res['data'] as $row)
                        {
                            echo "<tr>";
                            echo "<td>". $row['name']."</td>";
                            echo "<td>". $row['user_type']."</td>";
                            echo "<td>". $row['mobile']."</td>";
                            echo "<td align='right'>". $row['current_wallet']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    </div>
                </div>
        </div>
        </div>
       
    </div>
    
    
    <div class="alert alert-info">
        <i class="fa fa-warning fa-2x"></i> &nbsp;&nbsp; Hello <b>&nbsp;<?php echo strtoupper($user_name);?> ! </b>This system is only permited to <?php echo $inst_name; ?>. It is not for commercial use. Username and password is confidential,do not share with any unauthorised person.
						Any query, comment write us <a href='mailto:<?php echo $dev_email; ?>' class='alert-link'><?php echo $dev_email; ?></a> or Call +91 <?php echo $dev_contact; ?>.
						Details, updates and terms to use are available on <a href='<?php echo $dev_url; ?>' title='<?php echo $dev_company; ?>' class='alert-link' > <?php echo $dev_url; ?> </a>.
                    </div>
                </div>
       
        
    </div>
        </div>
    </div>
	
<?php require_once('footer.php'); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Student'],
          ['Result Out',<?php  echo get_all('student','*',array('status'=>'RESULT OUT'))['count'];?>],
          ['Pending',  <?php  echo get_all('student','*',array('status'=>'PENDING'))['count'];?>],
          ['Verified', <?php  echo get_all('student','*',array('status'=>'VERIFIED'))['count'];?>],
          ['Block', <?php  echo get_all('student','*',array('status'=>'BLOCK'))['count'];?>],
          ['Result Waiting', <?php  echo get_all('student','*',array('status'=>'RESULT UPDATED'))['count'];?> ]
        ]);

        var options = {
          title: "Student Statics ",
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>