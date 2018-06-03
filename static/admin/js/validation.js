var alphNumExp=  /^[0-9a-zA-Z]+$/;
var alphaExp = /^[a-zA-Z\ ]+$/;
var numDotExp = /^[0-9.]+$/;
var numExp = /^[0-9]+$/;
var numHyphenExp = /^[0-9-.]+$/;

var SKUExp = /^[[0-9a-zA-Z-]+$/;
var itemNameExp = /^[[0-9a-zA-Z]+$/;


function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function validate_raw_data()
{
	if(trim($("#txtCategory").val()) == 0)
	{
		alert('Please select Category Name.');	
		$("#txtCategory").focus();
		return false;
	}
	if(trim($("#txtSubCategory").val()) == 0)
	{
		alert('Please select Sub-category Name.');	
		$("#txtSubCategory").focus();
		return false;
	}
	if(trim($("#txtManufacturer").val()) == 0)
	{
		alert('Please select Manufacturer Name.');	
		$("#txtManufacturer").focus();
		return false;
	}
	if(!alphNumExp.test($("#txtUserSKU").val()))
	{
		alert('Please enter valid user sku.');	
		$("#txtUserSKU").focus();
		return false;
	}
	if(trim($("#txtModleName").val()) == '')
	{
		alert('Please enter Model Name.');	
		$("#txtModleName").focus();
		return false;
	}
	if(!alphaExp.test($("#txtModleName").val()))
	{
		alert('Please enter valid Model Name.');	
		$("#txtModleName").focus();
		return false;
	}
	if(trim($("#txtSKUNo").val()) == '')
	{
		alert('Please enter sku number.');	
		$("#txtSKUNo").focus();
		return false;
	}
	if(!SKUExp.test($("#txtSKUNo").val()))
	{
		alert('Please enter valid sku number.');	
		$("#txtSKUNo").focus();
		return false;
	}
	//return false;
	if(trim($("#txtCubicFeet").val()) == '')
	{
		$("#txtCubicFeet").val('0');
		
	}
	if(!numDotExp.test($("#txtCubicFeet").val()))
	{
		alert('Please enter valid Cubic Feet.');	
		$("#txtCubicFeet").focus();
		return false;
	}
	if(trim($("#txtSKUWeight").val()) == '')
	{
		$("#txtSKUWeight").val('0');
	}
	if(!numDotExp.test($("#txtSKUWeight").val()))
	{
		alert('Please enter valid SKU Weight.');	
		$("#txtSKUWeight").focus();
		return false;
	}
	if(trim($("#hdnSmallImage").val()) == '')
	{
		alert('Please chose small image.');	
		$("#txtSmallImage").focus();
		return false;
	}
	
	if(trim($("#hdnLargImage").val()) == '')
	{
		alert('Please choose larg image.');	
		$("#txtLargeImage").focus();
		return false;
	}
	if(!numDotExp.test($("#txtWholesale_Cost").val()))
	{
		alert('Please enter valid whole sale cost.');	
		$("#txtWholesale_Cost").focus();
		return false;
	}
	if(trim($("#txtSalePrice").val()) == '')
	{
		alert('Please enter sale price.');	
		$("#txtSalePrice").focus();
		return false;
	}
	if(!numDotExp.test($("#txtSalePrice").val()))
	{
		alert('Please enter valid sale price.');	
		$("#txtSalePrice").focus();
		return false;
	}
	if(Number($("#txtSalePrice").val()) <= Number($("#txtWholesale_Cost").val()))
	{
		alert('Sale Price must be greater than cost price.');	
		$("#txtSalePrice").focus();
		return false;
	}
	if(trim($("#txtMSRP").val()) != '' && !numHyphenExp.test($("#txtMSRP").val()))
	{
		alert('Please enter valid MSRP.');	
		$("#txtMSRP").focus();
		return false;
	}
	if(trim($("#txtCustomNoteReferance").val()) != '' && !alphaExp.test($("#txtCustomNoteReferance").val()))
	{
		alert('Please enter valid custom note.');	
		$("#txtCustomNoteReferance").focus();
		return false;
	}
	if(trim($("#txtItemAllow").val()) == '')
	{
		alert('Please enter item allow.');	
		$("#txtItemAllow").focus();
		return false;
	}
	if(!numExp.test($("#txtItemAllow").val()))
	{
		alert('Please enter valid item allow.');	
		$("#txtItemAllow").focus();
		return false;
	}
	return true;
}

function validate_feature()
{
	if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Feature Name.');	
		$("#txtName").focus();
		return false;
	}
	return true;
}

function valdiate_category(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Category Name.');	
		$("#txtName").focus();
		return false;
	}	
	if(trim($("#hdnCatImage").val()) == '')
	{
		alert('Please choose category image.');	
		$("#hdnCatImage").focus();
		return false;
	}
if(trim($("#txtDescription").val()) == '')
	{
		alert('Please enter Description.');	
		$("#txtDescription").focus();
		return false;
	}	
	return true;
}
function validate_subcategory(){
if(trim($("#lstCategory").val()) == 0)
	{
		alert('Please select Category Name.');	
		$("#lstCategory").focus();
		return false;
	}
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Sub-category Name.');	
		$("#txtName").focus();
		return false;
	}
if(trim($("#hdnCatImage").val()) == '')
	{
		alert('Please choose image.');	
		$("#hdnCatImage").focus();
		return false;
	}
	return true;
}
	
	
	
function validate_featureTypes(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Feature Name.');	
		$("#txtName").focus();
		return false;
	}
	return true;
}

	
function validate_featureDetails(){
if(trim($("#lstFeatureType").val()) == 0)
	{
		alert('Please select Feature Type.');	
		$("#lstFeatureType").focus();
		return false;
	}
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Feature Name.');	
		$("#txtName").focus();
		return false;
	}
	return true;
}
	
function validate_categoryFeature(){
if(trim($("#lstCategory").val()) == 0)
	{
		alert('Please select Category.');	
		$("#lstCategory").focus();
		return false;
	}
if(trim($("#lstSubCategory").val()) == 0)
	{
		alert('Please select Sub-category.');	
		$("#lstSubCategory").focus();
		return false;
	}
if(trim($("#lstFeaturType").val()) == 0)
	{
		alert('Please select Feature Type.');	
		$("#lstFeaturType").focus();
		return false;
	}

	return true;
}

function validate_outlets(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Outlet Name.');	
		$("#txtName").focus();
		return false;
	}
if(trim($("#txtAddress").val()) == '')
	{
		alert('Please enter Address.');	
		$("#txtAddress").focus();
		return false;
	}
if(trim($("#txtContact").val()) == '')
	{
		alert('Please enter Contact.');	
		$("#txtContact").focus();
		return false;
	}
if(trim($("#txtEmail").val()) == '')
	{
		alert('Please enter Email.');	
		$("#txtEmail").focus();
		return false;
	}

	return true;
}

function validate_outlets(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Outlet Name.');	
		$("#txtName").focus();
		return false;
	}
if(trim($("#txtAddress").val()) == '')
	{
		alert('Please enter Address.');	
		$("#txtAddress").focus();
		return false;
	}
if(trim($("#txtContact").val()) == '')
	{
		alert('Please enter Contact.');	
		$("#txtContact").focus();
		return false;
	}
if(trim($("#txtEmail").val()) == '')
	{
		alert('Please enter Email.');	
		$("#txtEmail").focus();
		return false;
	}

	return true;
}

function validate_pricerange(){
if(trim($("#txtRangeFrom").val()) == '')
	{
		alert('Please enter starting Price Range.');	
		$("#txtRangeFrom").focus();
		return false;
	}
if(trim($("#txtRangeTo").val()) == '')
	{
		alert('Please enter ending Price Range.');	
		$("#txtRangeTo").focus();
		return false;
	}
	return true;
}

function validate_manufacte(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter Manufacturer Name.');	
		$("#txtName").focus();
		return false;
	}
if(trim($("#txtSKUType").val()) == '')
	{
		alert('Please enter SKU Type.');	
		$("#txtSKUType").focus();
		return false;
	}
	return true;
}

function validate_login(){
if(trim($("#txtName").val()) == '')
	{
		alert('Please enter User Name.');	
		$("#txtName").focus();
		return false;
	}
if(trim($("#txtPassword").val()) == '')
	{
		alert('Please enter Password.');	
		$("#txtPassword").focus();
		return false;
	}
	return true;
}