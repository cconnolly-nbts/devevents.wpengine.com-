xhr=new XMLHttpRequest;
if (formFirstName != '') { 
	firstNameData = '&first_name='+formFirstName;
} else {
	firstNameData = '';
}
if (formLastName != '') { 
	lastNameData = '&last_name='+formLastName;
} else {
	lastNameData = '';
}
if (formTeamName != '') { 
	teamNameData = '&team_name='+formTeamName;
} else {
	teamNameData = '';
}
var searchData = "https://secure2.convio.net/bts/site/CRTeamraiserAPI?method=getParticipants&event_type=TeamraiserEvents"+firstNameData+lastNameData+teamNameData+"&v=1.0&api_key=thooG9Ke"
xhr.open("GET",searchData,false);
xhr.send();
xmlDoc=xhr.responseXML;
var x=xmlDoc.getElementsByTagName("participant");
var count = 0;
for(i=0;i<x.length;i++){
	count++;
}

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 }
if (!count) {
	document.write("<div class='spacer'><p>There were no results for your search. Please <a href='/tr-search-results/'>try your search again</a>.</p></div>");
} else {
	for(i=0;i<x.length;i++){
	if(x[i].getElementsByTagName("first")[0].hasAttribute("xsi:nil")){
		var firstName=""
	}else{
		var firstName=x[i].getElementsByTagName("first")[0].childNodes[0].nodeValue}
	if(x[i].getElementsByTagName("last")[0].hasAttribute("xsi:nil")){
		var lastName=""
	}else{
		var lastName=x[i].getElementsByTagName("last")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("donationUrl")[0].hasAttribute("xsi:nil")){
		var donateUrl=""
	}else{
		var donateUrl=x[i].getElementsByTagName("donationUrl")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("personalPageUrl")[0].hasAttribute("xsi:nil")){
		var pageUrl=""}else{var pageUrl=x[i].getElementsByTagName("personalPageUrl")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("eventName")[0].hasAttribute("xsi:nil")){
		var eventName=""
	}else{
		var eventName=x[i].getElementsByTagName("eventName")[0].childNodes[0].nodeValue
	}
	var teamCaptian=x[i].getElementsByTagName("aTeamCaptain")[0].childNodes[0].nodeValue;
	if(x[i].getElementsByTagName("teamName")[0].hasAttribute("xsi:nil")){
		var teamName=""
	}else{
		var teamName=x[i].getElementsByTagName("teamName")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("teamPageUrl")[0].hasAttribute("xsi:nil")){
		var teamPageUrl=""
	}else{
		var teamPageUrl=x[i].getElementsByTagName("teamPageUrl")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("goal")[0].hasAttribute("xsi:nil")){
		var goal=""
	}else{
		var goal=x[i].getElementsByTagName("goal")[0].childNodes[0].nodeValue
	}
	if(x[i].getElementsByTagName("amountRaised")[0].hasAttribute("xsi:nil")){
		var amountRaised=""
	}else{
		var amountRaised=x[i].getElementsByTagName("amountRaised")[0].childNodes[0].nodeValue
	}
	document.write("<div class='result'><div class='spacer pure-g-r'><div class='pure-u-2-3'>");
	document.write("<h3><a href='"+pageUrl+"'>"+firstName+" "+lastName+"</a></h3>");
	if(eventName!=""){
		document.write("<p class='eventName'>Event: "+eventName+"</p>")
	}
	if(teamPageUrl!=""){
		document.write("<p class='teamLink'>Team: <a href='"+teamPageUrl+"'>"+teamName+"</a></p>")
	}
	if(goal!=""){
		document.write("<p class='goal'>Fundraising goal: $"+(goal/100).formatMoney(2) +"</p>")	//("<p class='goal'>Fundraising goal: $"+goal+"</p>")(goal/100).toFixed( 2 )
	}
	if(amountRaised!=""){
		document.write("<p class='amountRaised'>Amount raised: $"+amountRaised+"</p>")
	}
	document.write("</div><div class='pure-u-1-3'>");
	if(donateUrl!=""){
		document.write("<p class='donateLink'><a class='pure-button search-donate-button' href='"+donateUrl+"'>Donate to me</a></p>")
	}
	document.write("</div></div></div>")
	}

}
	