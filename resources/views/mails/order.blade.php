Xin chào <i>{{ $data['name'] }}</i>,
<p>Cảm ơn bạn đã đặt tour tại website chúng tôi? Chúng tôi sẽ sớm liên hệ với bạn</p>
 
<p><u>Thông tin tour bạn đã đặt: </u></p>
 
<div>
	<table cellpadding="8" cellspacing="0" border="1">
		<tr bgcolor="yellow">
			<th>Tên</th>
			<th>Email</th>
			<th>Số điện thoại</th>
			<th>Số lượng người lớn</th>
			<th>Số lượng trẻ em</th>
		</tr>
		<tr>
			<td>{{ $data['name'] }}</td>
			<td>{{ $data['email'] }}</td>
			<td>{{ $data['phone'] }}</td>
			<td>{{ $data['num_adults'] }}</td>
			<td>{{ $data['num_childs'] }}</td>
		</tr>
	</table>
</div>
<br>
<br>
Thank You,
<br/>
<i>{{ $data['name'] }}</i>