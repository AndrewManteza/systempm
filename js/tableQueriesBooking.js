$(document).ready(function() {

		var prev=['open'];

 

	  if($('input[type=radio][name=tabs]').val()=='open')
	  {

	  	$(`#content1`).html(`
	  		<form method="POST" action="process/tableRequest.php">
         	 <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Contact Details</th>
		                <th>Ordered in</th>
		                  <th>Address</th>
                        <th>Orders</th>
                        <th>Options</th>
                       
                    </tr>
                </thead>
                <tfoot>
                  <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Contact Details</th>
		                <th>Ordered in</th>
		                   <th>Address</th>
                        <th>Orders</th>
                        <th>Options</th>
                    
                  </tr>
                </tfoot>
          
            </table>
         </form>

            <div id="myModal" class="modal">
              <div class="modal-content">
                <div class="modal-header">
                  <center><h2>Orders & Comment</h2></center>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>`);

	  	$.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                      sql: `SELECT *  FROM pm_client WHERE client_status='open' `,
                  
                    
                    },
                    cache: false,
                    success: function(dataResult)
                    {		
                    	var data= dataResult.split("return$gfdbJSON$");
                        var dataSource=jQuery.parseJSON(data[1]);
                        tableContent(dataSource);
                    }
                });

	  	$(`#content1`).show();


	  }

	  $('input[type=radio][name=tabs]').change(function()
      { 	prev.push(this.value);
      	
      	 	if(prev.length>1)
      	 	{	
      	 		
      	 		$(`#${getContent(prev[0])}`).html(``);
      	 		document.getElementById(`${getContent(prev[0])}`).style='';
      	 		prev.shift();
      	 	}
   
      	 $(`#${getContent(this.value)}`).html(` 
		   <form method="POST" action="process/tableRequest.php">
		      <table id="example" class="display" style="width:100%">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>Client Name</th>
		                    <th>Contact Details</th>
		                    <th>Ordered in</th>
		                     <th>Address</th>
		                    <th>Orders</th>
		                    <th>Options</th>
		                   
		                </tr>
		            </thead>
		            <tfoot>
		              <tr>
		                    <th>ID</th>
		                    <th>Client Name</th>
		                    <th>Contact Details</th>
		                    <th>Ordered in</th>
		                     <th>Address</th>
		                    <th>Orders</th>
		                    <th>Options</th>
		                
		              </tr>
		            </tfoot>
		      
		        </table>
		     </form>

		        <div id="myModal" class="modal">
		          <div class="modal-content">
		            <div class="modal-header">
		              <center><h2>Orders & Comment</h2></center>
		            </div>
		            <div class="modal-body">
		            </div>
		            <div class="modal-footer">
		            </div>
		        </div>`
		        );	
      	 $(`#${getContent(this.value)}`).hide();
      	 $(`#${getContent(this.value)}`).slideToggle("very slow");


      	 $.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                      sql: `SELECT *  FROM pm_client WHERE client_status='${this.value}' `,
                  
                    
                    },
                    cache: false,
                    success: function(dataResult)
                    {		
                    	

                    	var data= dataResult.split("return$gfdbJSON$");
                        var dataSource=jQuery.parseJSON(data[1]);
                        tableContent(dataSource);
                    		
					}
				});

		 });


} );



function tableContent(dataSource)
{
	$(document).ready(function()
	{


                    		if (dataSource.length==0) 
                    		{	
                    			var	table1=$(`#example`).DataTable({
									        data:dataSource,
									        "order": [[1, 'asc']]
									    });
                    		}
                    		else
                    		{
								var	table=$(`#example`).DataTable({
									        data:dataSource,
									        "columns": [
									            {
									                "render":
									                function(data,type,row)
										            {
										      				return `
										            	<i class="fa fa-id-card" aria-hidden="true"> ${row.id}</i>`
										            	
										            }  
									            },
									            {

									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"> ${row.client_fullname}</i>`;
										            }  
										        },
									            {	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
															return `
															<i class="fa fa-facebook" aria-hidden="true"> facebook: ${row.client_fbname}</i><br><br>
															<i class="fa fa-envelope" aria-hidden="true"> email: ${row.client_email}</i><br><br>
															<i class="fa fa-phone" aria-hidden="true"> phone: ${row.client_phonenumber}</i>`;
												    }  
										        },

										        {	
									            
									            	"render":
									                function(data,type,row)
										            {
															return `<i class="fa fa-calendar" aria-hidden="true"> ${row.client_ordered}</i>`;
												    }  
										        },
										        {
										        	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fa fa-location-arrow" aria-hidden="true" style="font-size: 15px;"> ${row.client_address}</i>`;
										            }  
										        },

									            {
									            	"className":      'orders',	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
												            	return `
												            	<button type="button" class="btn btn-primary"  value="orders"><i class="fa fa-shopping-cart"></i> Orders</button
															`;
										          }  
										        },
									            { 

									              "className":      'getIdToProcess',
									              "orderable":      false,
									              "render":
									              function(data,type,row)
									              {
									              	if (row.client_status=='open') 
										      		{
										      			return `<input type="submit" class="btn btn-primary" value="confirm" name="open">
										      					<input type="submit" class="btn btn-warning" value="cancel" name="cancel">
									              			    <input type="submit" class="btn btn-danger" value="reject" name="reject">	`;
										      		}
										      		else if (row.client_status=='confirm') 
										      		{
										      			return `<input type="submit" class="btn btn-primary" value="Done" name="done">
									              			    <input type="submit" class="btn btn-warning" value="cancel" name="cancel">
									              			   `;
										      		}
										      		else if(row.client_status=='cancel')
										      		{	
										      			return `<button type="submit" name="delete" onclick="return confirm('Do you realy want to delete this product/s?')" class="btn btn-danger " ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
									              			   `;
										      		}
										      		else if (row.client_status=='reject') 
										      		{
										      			return `<button type="submit" name="delete" onclick="return confirm('Do you realy want to delete this product/s?')" class="btn btn-danger " ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
									              			    <input type="submit" class="btn btn-primary" value="Re-confirm" name="open">
									              			   `;
										      		
										      		}
										      		else if (row.client_status=='done') 
										      		{
										      			return `<button type="submit" name="delete" onclick="return confirm('Do you realy want to delete this product/s?')" class="btn btn-danger " ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
									              			   `;
										      		
										      		}
									              }
									           
									            }
									        ],
									        "order": [[1, 'asc']]
									    });	


										//GET THE ID OF PARTICULAR CLICK BUTTON
										$(`#example`).on('click', `td.getIdToProcess`, function () 
									    {		

										        var tr = $(this).closest('tr');
										        var row = table.row( tr );
											    var dataId=row.data().id;

											    var inners=$(`td.getIdToProcess`).append(`
												    	<input type="hidden" value="${dataId}" name="clientid">`);	
																
									    });
									    $(`#example`).on('click', `td.open`, function () 
									    {		

										        var tr = $(this).closest('tr');
										        var row = table.row( tr );
											    var dataId=row.data().id;

											    var inners=$(`td.open`).append(`
												    	<input type="hidden" value="${dataId}" name="clientid">`);	
																
									    });



										$(`#example`).on('click',`td.orders`, function ()
										{	
											  var tr = $(this).closest('tr');
										      var row = table.row( tr );
											  var dataId=row.data().id;
											  var modal = document.getElementById("myModal");
											  var span = document.getElementsByClassName("close")[0];   
												

										 $.ajax({
											        url: "process/jsonConverter.php",
								                    type: "POST",
								                    data: 
								                    {
								                      sql: `SELECT
															c.id,c.client_fullname,c.client_fbname,c.client_email,c.client_phonenumber,c.client_status,c.client_expense,c.client_ordered ,
															b.product_name,b.product_price, r.client_id,r.product_id,r.quantity,r.comments
															FROM  pm_client_bridge r
															INNER JOIN pm_product b ON r.product_id=b.id
															INNER JOIN pm_client c ON r.client_id = c.id  `,
								                    
								                    },
								                    cache: false,
								                    success: function(dataResult)
								                    {		
								                    	

								                    	var data= dataResult.split("return$gfdbJSON$");
								                        var dataSource=jQuery.parseJSON(data[1]);
											       		  var items = [];
											       	 $.each(dataSource, function(key, val) {

											       	 		if (val.id==dataId) 
											       	 		{	
											       	 				items.push(val)
											       	 		}
											            //items.push('<li id="' + key + '">' + val + '</li>');    
											          });
											     	var peste ='';
											     	var total=0;
											     	var name;
											       	for(var i=0;i<items.length;i++)
											       	{	var comment=items[i]['comments'].split('=');
											       		var multiply=parseInt(items[i]['quantity'])*parseInt(items[i]['product_price']);
											       			 total+=multiply;
											       		 peste+=`
												       		  	<tr>
												       		  		<td>${items[i]['product_name']}</td>
												       		  		<td>${items[i]['quantity']}</td>
												       		  		<td>${items[i]['product_price']}</td>
												       		  		<td>${comment[1]}</td>
												       		  		<td>₱ ${multiply}</td>
												       		  		
												       		  	</tr>
											       		   `;
											       		   name=items[i]['client_fullname']
											       		  
											       	}

											       	$('.modal-header').html(`<i class="fa fa-shopping-cart" style="margin-right:10px;"</i> ${name}<p>Orders and Comments</p>`);
											       			peste+=`<tr>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td>₱ ${total}</td>
												       		  	</tr>`;


														       	$('.modal-body').html(`
														       		<table class="table">
															       		<thead>
															                <tr>
															                    <th>Product</th>
															                    <th>Quantity</th>
															                    <th>Price</th>
															                    <th>Comments</th>
															                    <th>Total</th>
															                </tr>
															            </thead>
															            <tbody>
															            ${peste}
															            </tbody>
															         </table>

															    `);

														       }

											  });
											  modal.style.display = "block";
											  
											  window.onclick = function(event) 
											  {
											  if (event.target == modal) 
											    {
											    	 $('.modal-header').html(``);
									                  $('.modal-body').html(``);
											   	 modal.style.display = "none";
											    }
											  }
										});
									}




	});
}

function getContent(content)
{
	var contentno;
	switch(content)
    {
		case 'open':
				contentno='content1';
	   			break;
	 	case 'confirm':
	 			contentno='content2';
	 			break;
	    case 'cancel':
	    		contentno='content3';
	   		 	break;
	   	case 'reject':
	   			contentno='content4';
	 			break;
	    case 'done':
	    		contentno='content5';
	   		 	break;
   }
   return contentno;

}











