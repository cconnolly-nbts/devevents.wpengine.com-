function eventInfoSearch(){
	var e=xmlDoc.getElementsByTagName("teamraiser");
	for(i=0;i<e.length;i++){
		if(e[i].getElementsByTagName("name")[0].hasAttribute("xsi:nil")){
			var t=""
		}else{
			var t=e[i].getElementsByTagName("name")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("city")[0].hasAttribute("xsi:nil")){
			var n=""
		}else{
			var n=e[i].getElementsByTagName("city")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("city")[0].hasAttribute("xsi:nil")){
			var r=""
		}else{
			var r=e[i].getElementsByTagName("state")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("location_name")[0].hasAttribute("xsi:nil")){
			var s=""
		}else{
			var s=e[i].getElementsByTagName("location_name")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("area")[0].hasAttribute("xsi:nil")){
			var o=""
		}else{
			var o=e[i].getElementsByTagName("area")[0].childNodes[0].nodeValue
		}
		var unformattedDate=new Date(e[i].getElementsByTagName("event_date")[0].childNodes[0].nodeValue);
		var formattedDate=$.PHPDate("l, F j, Y", unformattedDate);
		if(formattedDate != 'Wednesday, December 31, 1969') {
			var u = formattedDate;
		}else{
			var u = '<em>Event date coming soon</em>';
		}
		var a=e[i].getElementsByTagName("donate_event_url")[0].childNodes[0].nodeValue;
		var f=e[i].getElementsByTagName("reg_indiv_url")[0].childNodes[0].nodeValue;
		var l=e[i].getElementsByTagName("reg_join_team_url")[0].childNodes[0].nodeValue;
		var c=e[i].getElementsByTagName("reg_new_team_url")[0].childNodes[0].nodeValue;
		var h=e[i].getElementsByTagName("accepting_donations")[0].childNodes[0].nodeValue;
		var p=e[i].getElementsByTagName("accepting_registrations")[0].childNodes[0].nodeValue;
		document.write("<div class='result'><div class='spacer'><div class='pure-g-r'><div class='pure-u-2-3'>");
		if(o!=""){
			document.write("<a href='"+o+"'>")
		}
		document.write("<h3>"+t+"</h3>");
		if(o!=""){
			document.write("</a>")
		}
		if(s!=""&&n!=""&&r!=""){
			document.write('<p class="location">')
		}
		if(s!=""){
			document.write(s)
		}
		if(s!=""&&(n!=""||r!="")){
			document.write(", ")
		}
		if(n!=""){
			document.write(n)
		}
		if(n!=""&&r!=""){
			document.write(", ")
		}
		if(r!=""){
			document.write(r)
		}
		if(s!=""&&n!=""&&r!=""){
			document.write("</p>")
		}
		document.write("<p class='date'>"+u+"</p></div><div class='pure-u-1-3'>");
		if(h=="true"){
			document.write("<p class='donateLink'><a class='pure-button event-donate-button' href='"+a+"'>Donate to this event</a></p>")
		}
		if(p=="true"){
			document.write("<p class='registerInivLink'><a class='pure-button event-register-individual-button' href='"+f+"'>Register as an individual</a></p>");
			document.write("<p class='joinLink'><a class='pure-button event-join-team-button' href='"+l+"'>Join a team</a></p>");
			document.write("<p class='registerTeamLink'><a class='pure-button event-register-team-button' href='"+c+"'>Register a new team</a></p><p class='registerTeamLink'><a class='pure-button event-register-team-button' href='"+f+"'>Sign Up to Volunteer</a></p>")
		}
		document.write("</div></div></div></div>")
		}}
		
function eventZipSearch(){
	var e=xmlDoc.getElementsByTagName("teamraiser");
	for(i=0;i<e.length;i++){
		if(e[i].getElementsByTagName("name")[0].hasAttribute("xsi:nil")){
			var t=""
		}else{
			var t=e[i].getElementsByTagName("name")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("city")[0].hasAttribute("xsi:nil")){
			var n=""
		}else{
			var n=e[i].getElementsByTagName("city")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("city")[0].hasAttribute("xsi:nil")){
			var r=""
		}else{
			var r=e[i].getElementsByTagName("state")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("location_name")[0].hasAttribute("xsi:nil")){
			var s=""
		}else{
			var s=e[i].getElementsByTagName("location_name")[0].childNodes[0].nodeValue
		}
		if(e[i].getElementsByTagName("area")[0].hasAttribute("xsi:nil")){
			var o=""
		}else{
			var o=e[i].getElementsByTagName("area")[0].childNodes[0].nodeValue
		}
		var unformattedDate=new Date(e[i].getElementsByTagName("event_date")[0].childNodes[0].nodeValue);
		var formattedDate=$.PHPDate("l, F j, Y", unformattedDate);
		if(formattedDate != 'Wednesday, December 31, 1969') {
			var u = formattedDate;
		}else{
			var u = '<em>Event date coming soon</em>';
		}
		var a=e[i].getElementsByTagName("distance")[0].childNodes[0].nodeValue;
		var f=e[i].getElementsByTagName("donate_event_url")[0].childNodes[0].nodeValue;
		var l=e[i].getElementsByTagName("reg_indiv_url")[0].childNodes[0].nodeValue;
		var c=e[i].getElementsByTagName("reg_join_team_url")[0].childNodes[0].nodeValue;
		var h=e[i].getElementsByTagName("reg_new_team_url")[0].childNodes[0].nodeValue;
		var p=e[i].getElementsByTagName("accepting_donations")[0].childNodes[0].nodeValue;
		var d=e[i].getElementsByTagName("accepting_registrations")[0].childNodes[0].nodeValue;
		document.write("<div class='result'><div class='spacer'><div class='pure-g-r'><div class='pure-u-2-3'>");
		if(o!=""){
			document.write("<a href='"+o+"'>")
		}
		document.write("<h3>"+t+"</h3>");
		if(o!=""){
			document.write("</a>")
		}
		if(s!=""&&n!=""&&r!=""){
			document.write('<p class="location">')
		}
		if(s!=""){
			document.write(s)
		}
		if(s!=""&&(n!=""||r!="")){
			document.write(", ")
		}
		if(n!=""){
			document.write(n)
		}
		if(n!=""&&r!=""){
			document.write(", ")
		}
		if(r!=""){
			document.write(r)
		}
		if(s!=""&&n!=""&&r!=""){
			document.write("</p>")
		}
		document.write("<p class='date'>"+u+"</p>");
		document.write("<p class='distance'>Distance: "+a+" miles</p></div><div class='pure-u-1-3'>");
		if(h=="true"){
			document.write("<p class='donateLink'><a class='pure-button' href='"+f+"'>Donate to this event</a></p>")
		}
		if(p=="true"){
			document.write("<p class='registerInivLink'><a class='pure-button' href='"+l+"'>Register as an individual</a></p>");
			document.write("<p class='joinLink'><a class='pure-button' href='"+c+"'>Join a team</a></p>");
			document.write("<p class='registerTeamLink'><a class='pure-button' href='"+c+"'>Register a new team</a></p><a class='pure-button event-register-team-button' href='"+l+"'>Sign Up to Volunteer</a></p>")
		}
		document.write("</div></div></div></div>")
		}}
		xhr=new XMLHttpRequest;
		xhr.open("GET","https://secure2.convio.net/bts/site/CRTeamraiserAPI?api_key=thooG9Ke&v=1.0&method=getTeamraisersByDistance&starting_postal="+formData+"&search_distance=200&distance_units=mi&event_type=TeamraiserEvents",false);
		xhr.send();
		xmlDoc=xhr.responseXML;
		var totalResultsZip=+xmlDoc.getElementsByTagName("totalNumberResults")[0].childNodes[0].nodeValue;
		if(totalResultsZip!=0){
			eventZipSearch()
		}
		xhr.open("GET","https://secure2.convio.net/bts/site/CRTeamraiserAPI?api_key=thooG9Ke&v=1.0&method=getTeamraisersByInfo&name="+formData+"&event_type=TeamraiserEvents",false);
		xhr.send();
		xmlDoc=xhr.responseXML;
		totalResultsInfo=+xmlDoc.getElementsByTagName("totalNumberResults")[0].childNodes[0].nodeValue;
		if(totalResultsInfo!=0){
			eventInfoSearch()
		}
		if(totalResultsZip + totalResultsInfo == 0) {
			document.write('<div class="spacer"><p>There were no results for your search. Please <a href="/tr-search-results/">try your search again</a>.</p></div>');
		}