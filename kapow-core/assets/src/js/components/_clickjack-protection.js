// Clickjacking Protection
// The HTTP header X-Frame-Options: SAMEORIGIN should be set.
// Older browsers do not support this header, so the following
// JavaScript will act as a workaround.
try { top.document.domain } catch (e) {
	var f = function() { document.body.innerHTML = ''; }; setInterval(f, 1);
	if (document.body) document.body.onload = f;
}
