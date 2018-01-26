

			</div>
		</div>
	  </div>

    <script type="text/javascript">
         $(document).ready(function () {	
         $(".list-unstyled > li ").click(function(){
         $(".list-unstyled li").removeClass();
          	$(this).addClass("active");
          });
         });
         
      </script>
      <script>
         $(document).ready(function () {	
         $("#example_filter input").addClass("form-control");
         $("#example_filter input").attr("placeholder", "Ara");
         $("#example_length select").addClass("form-control");
         });
      </script>
      
<script type="text/javascript">
         // Ajax post
         $(document).ready(function() {
		 $derssorumlu=$(".acma2").find("#derssorumlu").val();	 
         $("#notifications").click(function(event) {
         event.preventDefault();
		 var logintip="<?= $this->session->loginType ?>";
		 if (logintip == "Komisyonuye")
		 {
			var ogrno=<?= $this->session->bolum_id ?>;
			if($derssorumlu==1)
			 {
				 var bolum_no=<?= $this->session->no ?>;
			 }			
		 }
		 else{
			 var ogrno=<?= $this->session->no ?>;
		 }
        
         
         if($derssorumlu!=1){
         jQuery.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>" + "Bildirim/bildirim_gorme", 
         dataType: 'json',
         data: {name: ogrno},
		 
         });
		 }
		 else
		 {
		  jQuery.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>" + "Bildirim/bildirim_gorme_alayi", 
         dataType: 'json',
         data: {name: ogrno,bolum:bolum_no},
		 
         });
		
		 }
         });
         });
      </script>
	  <script>
	  $( "#notifications" ).on( "click", function() {
	  $("#notifications #bsayisi").text('');
	 
	  });
	  
	  </script>
	  
	 
	<script type="text/javascript">  
	
         $("#b_gonder").click(function(event) {
         event.preventDefault();
        var ogr=$('select[name=o_ogr]').val();
		var mesaj=$("#mesaj").val();
        var bolum=<?= $this->session->bolum_id ?>;	 
		var isim="<?= $this->session->ad_soyad ?>";	 
        jQuery.ajax({
         type: 'POST',
         url: "<?php echo base_url(); ?>" + "Bildirim/bildirim_gonder", 
         dataType: 'html',
         data: {ogr: ogr, mesaj: mesaj, bolum: bolum, isim: isim},
		 success: function(data) {
			$("#mesaj").val(" ");
			$(".msg-success").show("slow");
			$(".msg-success").delay(3000).hide("slow");
			$(".burasi").hide();
			
		},
			error: function(data){
		   console.log(data);
			}
         });
		 
		 console.log(ogr);
         });
         
      </script>  
	
	  
<script>
	$( "#guncelle_button" ).click(function() {
		var inputs = document.getElementsByClassName("form-control p");
			for(var i = 0; i < inputs.length; i++) {
				inputs[i].disabled = false;
			}
			$( "#guncelle_button" ).removeClass( "fa fa-lock" ).addClass( "fa fa-unlock-alt" );
			$( "#btn_guncelle" ).css("visibility","visible");
			$( "#datePickerbita" ).attr("id","datePickerbit");
			$( "#datePickerbasa" ).attr("id","datePickerbas");

				$(function(){
						 $("#datePickerbas").datepicker({
				        	autoclose: true,
				            format: "yyyy-mm-dd",
				            language:"tr"
				        });
				
						 $("#datePickerbit").datepicker({
				        	autoclose: true,
				            format: "yyyy-mm-dd",
				            language:"tr"
							});
					}); 
					
		});

	
		
</script>
<script>
      $(document).ready(function () {	
      	$stajdurumu=$("#stajDurum").val();
      	$stajyeridurumu=$("#stajyeriDurum").val();
      	
      	var inputs = document.getElementsByClassName("form-control a");
      		for(var i = 0; i < inputs.length; i++) {
      		inputs[i].disabled = true;
      	}
      	
      	if(($stajdurumu==2 || $stajdurumu==0) && $stajyeridurumu==0){
      	$( "#guncelle_button" ).click(function() {
      		var inputs = document.getElementsByClassName("form-control a");
			
      		for(var i = 0; i < inputs.length; i++) {
      			inputs[i].disabled = false;
      		}  
      		$( "#guncelle_button" ).removeClass( "fa fa-lock" ).addClass( "fa fa-unlock-alt" );
      		$( "#btn_tekrarBasvuru" ).css("visibility","visible");
      		$( "#datePickerbita" ).attr("id","datePickerbit");
      		$( "#datePickerbasa" ).attr("id","datePickerbas");
      
      		$(function(){
      				 $("#datePickerbasgun").datepicker({
      					autoclose: true,
      					format: "yyyy-mm-dd",
      					language:"tr"
      				});
      		
      				 $("#datePickerbitgun").datepicker({
      					autoclose: true,
      					format: "yyyy-mm-dd",
      					language:"tr"
      					});
      			}); 
      
      });
      }
      
      	else if($stajdurumu==2 || $stajdurumu==0 && $stajyeridurumu==1){
      		
      		$( "#guncelle_button" ).click(function() {
      		var inputs = document.getElementsByClassName("form-control a b");
      		for(var i = 0; i < inputs.length; i++) {
      			inputs[i].disabled = false;
      		}
      		$( "#guncelle_button" ).removeClass( "fa fa-lock" ).addClass( "fa fa-unlock-alt" );
      		$( "#btn_tekrarBasvuru" ).css("visibility","visible");
      		$( "#checked" ).css("visibility","visible");
      		$( "#checked2" ).css("visibility","visible");
      		$( "#datePickerbita" ).attr("id","datePickerbit");
      		$( "#datePickerbasa" ).attr("id","datePickerbas");
      
      		$(function(){
      				 $("#datePickerbasgun").datepicker({
      					autoclose: true,
      					format: "yyyy-mm-dd",
      					language:"tr"
      				});
      		
      				 $("#datePickerbitgun").datepicker({
      					autoclose: true,
      					format: "yyyy-mm-dd",
      					language:"tr"
      					});
      			}); 
      
      });
      	}
      });
	  
   </script>
   <script>
$(".js-example-responsive").select2({
    width: 'resolve' // need to override the changed default
});
   </script>
<script>
	  $(".ozel-select").next().css('border', '1px solid #dad9d9');
	 
	  </script>

	  <script> 
	  $(document).ready(function () {	
	  	$( ".tolgaiskender" ).click(function()
		{
			 var logintip="<?= $this->session->loginType ?>";
		 if (logintip == "Komisyonuye")
		 {
			   var ogrno=<?= $this->session->bolum_id ?>;	   
		 }
		 else{
			 var ogrno=<?= $this->session->no ?>;
		 }
			deger=$(this).find('.baslik > .tur').val();
			tiklanma=$(this).find('.baslik > .tiklanma').val();
			if(deger=="1")
			{
				window.location.href="<?php echo base_url(); ?>" + "Stajbasvuru/basvuru_kabul";
			}
			else if(deger=="2")
			{
				window.location.href="<?php echo base_url(); ?>" + "Sirketler";
			}
			else if(deger=="3") 
			{
				window.location.href="<?php echo base_url(); ?>" + "Stajbasvuru";
			}
			else if(deger=="4")
			{
				window.location.href="<?php echo base_url(); ?>" + "profil";
			}
			else if(deger=="5")
			{
				window.location.href="<?php echo base_url(); ?>" + "Denetmen/ogrenci_listele";
			}
			else if(deger=="6")
			{
				window.location.href="<?php echo base_url(); ?>" + "Komisyon/ogrenci_kayit";
			}
			else if(deger=="7")
			{
				window.location.href="<?php echo base_url(); ?>" + "Ogrenci/Bitenstajlar/"+ogrno;
			}
			console.log(deger);
			console.log(tiklanma);
			jQuery.ajax({
			 type: 'POST',
			 url: "<?php echo base_url(); ?>" + "Bildirim/bildirim_tikla", 
			 dataType: 'json',
			 data: {tikla:tiklanma}
			});
			
			
		});
		
		
		});
	  
	  </script>

   <style>
   .buttons-print{ 
	        position: absolute;
    right: 0;
    margin-right: 23%;
    background-color: transparent;
    border: none;
    background-image: url(/tez/application_resources/img/printer.png);
	margin-top:1%;
	width:24px;
	height:24px;	
}
.buttons-print span {
  display: none;
}
</style>
<script>
$(document).ready(function () {	
	$('.parent-small').find('.icerikim').each(function(){
	notLength=$(this).text().length;
		if(notLength>50){
			yazi=$(this).text();
			kisitliyazi=yazi.substring(0,45);
			$(this).text(kisitliyazi+"...")
		}
	});
});

</script>


	
   </body>
      
</html>