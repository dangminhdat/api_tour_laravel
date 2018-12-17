<style type="text/css">
	.email-template {
		background: #fefcaa;
	    margin: auto;
	    padding: 4px 20px;
	    width: 47%;
	    border: 1px solid #bb2020;
	    border-radius: 16px;
	    font-family: cursive;
	}

	.email-template p {
		font-style: italic;
	}

	.email-template p label {
		font-weight: bold;
    	font-style: initial;
	}
</style>
Xin chào <i>{{ $data['name'] }}</i>,
<p>Cảm ơn bạn đã đặt tour tại chúng tôi? Chúng tôi sẽ sớm liên hệ với bạn</p>
 
<p><u>Thông tin tour bạn đã đặt: </u></p>
 
<div class="email-template" 
	style="background: #fefcaa;
	    margin: auto;
	    padding: 4px 20px;
	    width: 47%;
	    border: 1px solid #bb2020;
	    border-radius: 16px;
	    font-family: cursive;">
	<p><label>Tên: </label> {{ $data['name'] }}</p>
	<p><label>Email: </label> {{ $data['email'] }}</p>
	<p><label>Số điện thoại: </label> {{ $data['phone'] }}</p>
	<p><label>Số lượng người lớn: </label> {{ $data['num_adults'] }}</p>
	<p><label>Số lượng trẻ em: </label> {{ $data['num_childs'] }}</p>
	<p><label>Tên tour: </label> {{ $data['tour']->name }}</p>
	<p><label>Số ngày: </label> {{ $data['tour']->number_days }}</p>
	<p><label>Tiêu chuẩn: </label> {{ $data['tour']->item_tour }}</p>
	<p><label>Giảm giá: </label> {{ $data['tour']->discount }}</p>
	<p><label>Chương trình: </label> {{ $data['tour']->programs }}</p>
	<p><label>Lưu ý: </label> {{ $data['tour']->note }}</p>
	<p><label>Ngày khởi hành: </label> {{ $data['tour']->detail['date_depart'] }}</p>
	<p><label>Giờ khởi hành: </label> {{ $data['tour']->detail['time_depart'] }}</p>
	<p><label>Địa chỉ khởi hành: </label> {{ $data['tour']->detail['address_depart'] }}</p>
	<p><label>Giá người lớn: </label> {{ number_format($data['tour']->detail['price_adults'], 2) }}</p>
	<p><label>Giá trẻ em: </label> {{ number_format($data['tour']->detail['price_childs'], 2) }}</p>
	<p style="text-align: center;"><b>Tổng tiền: </b> {{ number_format($data['sum'], 2) }}</p>
</div>
<br>
<span style="color: re"></span>Thank You,
<br/>
<i>{{ $data['name'] }}</i>