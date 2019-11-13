<script>
function alphaOnly(evt) {
 var charCode = (evt.which) ? evt.which : event.keyCode
 console.log(charCode);
 if (charCode < 65 && charCode > 32 )
	return false;
 return true;
}
</script>