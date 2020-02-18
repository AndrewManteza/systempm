  $(document).ready(function()
    {

     
      /*This will get the date of the booking*/
      $(`.close`).on('click',function()
      {
          $(`.alert`).hide("slow"); //ALERT HIDER

      })

      //ijnhuybhygtbytbygtb

      var items = [];
      $.ajax({
           url: "process/jsonConverter.php",
           type: "POST",
           data: 
           {
             sql: `SELECT *  FROM schedule_table `,
        
          
           },
           cache: false,
           success: function(data) 
           {           
                      var data= data.split("return$gfdbJSON$");
                      var dataSource=jQuery.parseJSON(data[1]);
                       
                      $.each(dataSource, function(key, val) 
                      {
                           
                                    items.push(val)
                         //items.push('<li id="' + key + '">' + val + '</li>');    
                       
                      });
                      console.log(items);
                      var toPrint=$('#days').html('');//CLEARING THE DAYS INNERT HTML
                      var today = new Date(); // first param for year , second for the month, third for days
                      var d=new Date(today.getFullYear(),(today.getMonth()+1),0).toString().split(" ");
                      var monthVal=parseInt((today.getMonth()));//IDENTIFY THE CURRENT MONTH
                      $('#selected').html(exactMonth(monthVal));//CHANGE THE VALUE IN SELECT TO A PARTICULAR MONTH
                      var week=new Date(2020,today.getMonth(),1).toString().split(" "); //IDENTIFYING THE FIRST DAY OF THE MONTH
                      toSetNumba1First(week[0],d[2]);
                      var countBookThatDay=0;
                      var idsFromPlottedDate=[];

                      for(var i=0;i<d[2];i++)
                      {    
                         var plotDay;
                            if (i+1>9 && (today.getMonth())<10) 
                            {
                                 plotDay=`${today.getFullYear()}-0${(today.getMonth()+1)}-${i+1}`;
                            }
                            else if(i<9 && (today.getMonth())<10) 
                            {
                                 plotDay=`${today.getFullYear()}-0${(today.getMonth()+1)}-0${i+1}`;
                            }
                            else if(i<9 && (today.getMonth())>10) 
                            {
                                 plotDay=`${today.getFullYear()}-${(today.getMonth()+1)}-0${i+1}`;
                            }
                            else if(i+1>9 && (today.getMonth())>10) 
                            {
                                 plotDay=`${today.getFullYear()}-${(today.getMonth()+1)}-${i+1}`;
                            }
                            for(var j=0;j<items.length;j++)
                            {   
                            //change client ordered by adding more
                                if (plotDay==items[j]['set_Schedule']) 
                                {

                                  // add column id
                                    countBookThatDay++;
                                    idsFromPlottedDate.push(items[j]['id']);
                                }
                            }

                            if (countBookThatDay>0) 
                            {
                                $('#days').append(`<li><span class="active" id="${idsFromPlottedDate}" onclick="triggerModal(this)">
                                    ${i+1}</span></li>`);
                                countBookThatDay=0;
                                idsFromPlottedDate=[];
                            }
                            else
                            {
                                $('#days').append(`<li>${i+1}</li>`);

                            }
                            

                            
                      }


           
                  

                      $('#selected').on('change',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val());
                        var updated=new Date(2020,parseInt(monthVal)+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(monthVal),1).toString().split(" ");
                        var idsFromPlottedDateSelect=[];

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (today.getMonth())<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(monthVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (today.getMonth())<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(monthVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (today.getMonth())>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(monthVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (today.getMonth())>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(monthVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['set_Schedule']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateSelect.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateSelect}"  onclick="triggerModal(this)">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateSelect=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                              }


                      });



                      $('.prev').on('click',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val())-1;
                        var idsFromPlottedDatePrev=[];
                      
                        if (monthVal-1==-2) 
                        {
                          monthVal=11;
                        }
                        updateVal=monthVal;

                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(2020,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                     
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['set_Schedule']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDatePrev.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDatePrev}"  onclick="triggerModal(this)">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDatePrev=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }

                      });

                      $('.next').on('click',function()
                      {
                        $('#days').html('');
                        var monthVal=parseInt($('#selected').val())+1;
                        var idsFromPlottedDateNext=[];
                      
                        if (monthVal+1==13) 
                        {
                          monthVal=0;
                        }
                        updateVal=monthVal;

                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(2020,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(2020,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)<10) 
                                    {
                                         plotDay=`${today.getFullYear()}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && (updateVal)>10) 
                                    {
                                         plotDay=`${today.getFullYear()}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   

                                      //ASK
                                    
                                        if (plotDay==items[j]['set_Schedule']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateNext.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateNext}"  onclick="triggerModal(this)">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateNext=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }

                      });


                      $('#year').on('change',function()
                      {
                        var toPrint=$('#days').html('');
                        var monthVal=parseInt($('#selected').val());
                        var year=$('#year').val();
                        updateVal=monthVal;
                        var idsFromPlottedDateYear=[];


                        $('#selected').html(exactMonth(updateVal));
                        var updated=new Date(year,updateVal+1,0).toString().split(" ");
                        var weeked=new Date(year,parseInt(updateVal),1).toString().split(" ");

                        toSetNumba1First(weeked[0],updated[2]);
                              for(var i=0;i<updated[2];i++)
                              {    
                                 var plotDay;
                                    if (i+1>9 && updateVal<10) 
                                    {
                                         plotDay=`${year}-0${(updateVal+1)}-${i+1}`;
                                    }
                                    else if(i<9 && updateVal<10) 
                                    {
                                         plotDay=`${year}-0${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i<9 && updateVal>10) 
                                    {
                                         plotDay=`${year}-${(updateVal+1)}-0${i+1}`;
                                    }
                                    else if(i+1>9 && updateVal>10) 
                                    {
                                         plotDay=`${year}-${(updateVal+1)}-${i+1}`;
                                    }
                                    for(var j=0;j<items.length;j++)
                                    {   
                                    
                                        if (plotDay==items[j]['set_Schedule']) 
                                        {
                                            countBookThatDay++;
                                            idsFromPlottedDateYear.push(items[j]['id']);
                                        }
                                    }

                                    if (countBookThatDay>0) 
                                    {
                                        $('#days').append(`<li><span class="active" id="${idsFromPlottedDateYear}"  onclick="triggerModal(this)">${i+1}</span></li>`);
                                        countBookThatDay=0;
                                        idsFromPlottedDateYear=[];
                                    }
                                    else
                                    {
                                        $('#days').append(`<li>${i+1}</li>`);

                                    }
                                    

                                    
                              }



                              
                      });



                    $('#myModal').on('click',function()
                    {
                        $('#myModal').hide();
                    });

                    
            }
            
      });


                    

    });
function triggerModal(elem)

{

var modal = document.getElementById("myModal1");
modal.style.display = "block";






    $(document).ready(function()
    {
     /*    modal.style.display = "block";*/
        //var contentPanelId = (jQuery(this).attr("id")); get the id from the currennt click button but in jquery
         var id= (elem.id).split(","); //get the id from the current click button but in javascript
         $('.modal-body').html('');

        var items = [];
        $.ajax(
        {
           url: "process/jsonConverter.php",
           type: "POST",
           data: 
           {
            // change this
             sql: `SELECT *  FROM schedule_table `,
        
           },
           cache: false,
           success: function(data) 
           {           
                      var data= data.split("return$gfdbJSON$");
                      var dataSource=jQuery.parseJSON(data[1]);
                      
                 
                      $.each(dataSource, function(key, val) 
                      {
                             

                             for(var i=0; i< id.length;i++)
                             {
                                  if (val.id==id[i]) 
                                  {   
                                         items.push(val)
                                  }
                             }
                            
                         //items.push('<li id="' + key + '">' + val + '</li>');    
                       
                      });
                      console.log(items)

                    $('.modal-header').html(`<i class="fa fa-info-circle" style="margin-right:10px;"></i> Client/s who book this day`);
                    $('.modal-body').html(`
                                   <style>
                                * {
                                  box-sizing: border-box;
                                }

                                .slider {
                                  width: 100%;
                                  text-align: center;
                                  overflow: hidden;
                                }

                                .slides {
                                  display: flex;
                                  overflow-x: auto;
                                  scroll-snap-type: x mandatory;
                                  scroll-behavior: smooth;
                                  -webkit-overflow-scrolling: touch;
                                  

                                }
                                .slides::-webkit-scrollbar {
                                  width: 10px;
                                  height: 10px;
                                }
                                .slides::-webkit-scrollbar-thumb {
                                  background: black;
                                  border-radius: 10px;
                                }
                                .slides::-webkit-scrollbar-track {
                                  background: transparent;
                                }
                                .slides > div {
                                  scroll-snap-align: start;
                                  flex-shrink: 0;
                                  width: 100%;
                                  height: 350px;
                                  margin-right: 50px;
                                  border-radius: 10px;
                                  background: #eee;
                                  
                                }
                                .slides > div:target {
                                /*   transform: scale(0.8); */
                                }
                                .author-info {
                                  background: rgba(0, 0, 0, 0.75);
                                  color: white;
                                  padding: 0.75rem;
                                  position: absolute;
                                  bottom: 0;
                                  left: 0;
                                  width: 100%;
                                  margin: 0;
                                }
                                .author-info a {
                                  color: white;
                                }
                                img {
                                  object-fit: cover;
                                  position: absolute;
                                  top: 0;
                                  left: 0;
                                  width: 100%;
                                  height: 100%;
                                }

                                .slider > a {
                                  display: inline-flex;
                                  width: 1.5rem;
                                  height: 1.5rem;
                                  background: white;
                                  text-decoration: none;
                                  align-items: center;
                                  justify-content: center;
                                  border-radius: 50%;
                                  margin: 0 0 0.5rem 0;
                                  position: relative;
                                }
                                .slider > a:active {
                                  top: 1px;
                                }
                                .slider > a:focus {
                                  background: #000;
                                }
                                label{
                                    color: black !important;
                                }

                                /* Don't need button navigation */
                                @supports (scroll-snap-type) {
                                  .slider > a {
                                    display: none;
                                  }
                                }


                                body {
                                  align-items: center;
                                  justify-content: center;
                                  background: linear-gradient(to bottom, #74ABE2, #5563DE);
                                  font-family: 'Ropa Sans', sans-serif;
                                }
                                   </style>
                `);


                var slides="";
                                /*` <a href="#slide-1">1</a>
                                  <a href="#slide-2">2</a>
                                  <a href="#slide-3">3</a>
                                  <a href="#slide-4">4</a>
                                  <a href="#slide-5">5</a>`
                                    
                                  
                                                <div id="slide-2">
                                                  2
                                                </div>
                                                <div id="slide-3">
                                                  3
                                                </div>
                                                <div id="slide-4">
                                                  4
                                                </div>
                                                <div id="slide-5">
                                                  5
                                                </div>

                                  */
                 var contents="";                  
                for(var i = 0 ; i < items.length ; i++)
                {

                    slides+=`<a href="#slide-${i+1}">${i+1}</a>`;
                    contents+=`  
                    <div id="slide-${i+1}" style="font-size: 10px; color:b">
                            <div class="container" style="margin-top:20px;" >
                                <div class="row">
                                        <div class="col-md-6 content">
                                                <div class="form-group">
                                                <i class="fa fa-user" aria-hidden="true" style="font-size: 25px;"></i>
                                                        <label>Username:</label>
                                                </div>
                                    
                                        </div>
                                         <div class="col-md-6 content">
                                             <div class="form-group">
                                                <label>${items[i]['client_fullname']}</label>
                                             </div>
                                        </div>

                                         <div class="col-md-6 content">
                                                <div class="form-group">
                                                <i class="fa fa-facebook" aria-hidden="true" style="font-size: 20px;"></i>
                                                        <label>Facebook acc:</label>
                                                </div>
                                        </div>

                                         <div class="col-md-6 content">
                                             <div class="form-group">
                                                <label><ul>${items[i]['client_fbname']}</ul></label>
                                             </div>
                                        </div>

                                         <div class="col-md-6 content">
                                                <div class="form-group">
                                                <i class="fa fa-envelope" aria-hidden="true"  style="font-size: 20px;"></i>
                                                        <label>Email address:</label>
                                                </div>
                                        </div>

                                         <div class="col-md-6 content">
                                             <div class="form-group">
                                                <label><ul>${items[i]['client_email']}</ul></label>
                                             </div>
                                        </div>

                                         <div class="col-md-6 content">
                                                <div class="form-group">
                                                <i class="fa fa-location-arrow" aria-hidden="true"  style="font-size: 20px;"></i>
                                                        <label>Address:</label>
                                                </div>
                                        </div>

                                         <div class="col-md-6 content">
                                             <div class="form-group">
                                                <label><ul>${items[i]['client_address']}</ul></label>
                                             </div>
                                        </div>

                                        <div class="col-md-6 content">
                                                <div class="form-group">
                                                <i class="fa fa-phone" aria-hidden="true" style="font-size: 20px;"></i>
                                                        <label>Phone number:</label>
                                                </div>
                                        </div>

                                         <div class="col-md-6 content">
                                             <div class="form-group">
                                                <label><ul>${items[i]['client_phonenumber']}</ul></label>
                                             </div>
                                        </div>



                                 
                                </div>

                            </div>
                             

                       
                       
                    </div>`;
                }
        
        /*  <strong>Name</strong>: <b>${items[i]['client_fullname']}</b> <br>
                    <strong>Facebook</strong>: <b>${items[i]['client_fbname']}</b> <br>
                    <strong>Email</strong>: <b>${items[i]['client_email']}</b> 
                    <strong>Password</strong>: <b>${items[i]['client_phonenumber']}</b> <br>
*/




                    $('.modal-body').append(`
                                  <div class="slider">
                                    ${slides}

                                        <div class="slides">
                                                ${contents}
                                        </div>
                                  </div>`
                                );






                      console.log(items);
           }
       });


            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
                $('.modal-header').html(``);
                $('.modal-body').html('');
           
              }
            }


    });
          /*var modal = document.getElementById("myModal");
          //var span = document.getElementsByClassName("close")[0];   
      
          window.onclick = function(event) 
          {
              if (event.target != modal) 
              {
                modal.style.display = "none";
              }
          }*/
       
}
function exactMonth(month)
  {
    if (month==0) 
    {
     return `
     <option value="0" selected>Jan</option>
         <option value="1">Feb</option>
         <option value="2">March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;

    }
    else if (month==1) 
    {

     return `
     <option value="0" >Jan</option>
         <option value="1" selected>Feb</option>
         <option value="2">March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==2) 
    { 
       return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" selected>March</option>
         <option value="3">April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==3) 
    {
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" selected>April</option>
         <option value="4">May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==4) 
    { 
     
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" selected>May</option>
         <option value="5">June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==5) 
    {
     
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" selected>June</option>
         <option value="6">July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==6) 
    {
      return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" selected>July</option>
         <option value="7">August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==7) 
    {
     return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" selected>August</option>
         <option value="8">Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==8) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" selected>Sept</option>
         <option value="9">Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==9) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" selected>Oct</option>
         <option value="10">Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==10) 
    {
      return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" >Oct</option>
         <option value="10" selected>Nov</option>
         <option value="11">Dec</option>
         `;
    }
    else if (month==11) 
    {
    return `
     <option value="0" >Jan</option>
         <option value="1" >Feb</option>
         <option value="2" >March</option>
         <option value="3" >April</option>
         <option value="4" >May</option>
         <option value="5" >June</option>
         <option value="6" >July</option>
         <option value="7" >August</option>
         <option value="8" >Sept</option>
         <option value="9" >Oct</option>
         <option value="10" >Nov</option>
         <option value="11" selected>Dec</option>
         `;
    }

  }

    function toSetNumba1First(week,lastDay)
    {
      if (week=='Sat') 
      {
        $('#days').append(`<li  style="opacity:0.2;">${lastDay-5}</li><li style="opacity:0.2;">${lastDay-4}</li><li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Mon') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Tue') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Wed') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Thu') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else if (week=='Fri') 
      {
        $('#days').append(`<li style="opacity:0.2;">${lastDay-4}</li><li style="opacity:0.2;">${lastDay-3}</li><li style="opacity:0.2;">${lastDay-2}</li><li style="opacity:0.2;">${lastDay-1}</li><li style="opacity:0.2;">${lastDay}</li>`);
      }
      else
      {
        $('#days').append(``);
      }
    }