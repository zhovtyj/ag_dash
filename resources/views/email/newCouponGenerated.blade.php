<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Irank Dashboard</title>
<body>
<h1>Hi {{$coupon->user->name}}</h1>
<div><img src="http://agency.irank.website/img/iRank.png" style="display:block; width:100px; margin:0 auto;"></div>
<p>We are glad to inform you about new discount coupon on <a href="http://agency.irank.website/">agency.irank.website</a>.</p>
<p>Coupon: <strong style="background: #ccc;padding:5px;">{{$coupon->code}}</strong>.</p>
<p>Coupon is available until {{$coupon->expired_in}}.</p>
<p>Coupon is available only for your Agency (use your email for login).</p>
</body>
</html>


