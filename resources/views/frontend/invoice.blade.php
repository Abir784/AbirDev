
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
                            <tr>
                                <td>
									Invoice #: {{$bill_details->first()->order_id}}<br />
									Created: <br> {{$bill_details->first()->created_at->format('d-m-y')}}<br />

								</td>

								<td class="title">
									<img src="https://i.postimg.cc/rsMWz9NG/logo.jpg" alt="Company logo" style="width: 100%; max-width: 300px" />
								</td>


							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{$bill_details->first()->address}}
								</td>

                                <td></td>
								<td>
									{{$bill_details->first()->name}}<br />
									{{$bill_details->first()->company}}<br />
									{{$bill_details->first()->email}}<br />
									{{$bill_details->first()->phone}}

								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td colspan="8">
                    @php
                    if($orders->first()->delivery_method == 1){

                        echo "Cash On Delivery";

                    }elseif ($orders->first()->delivery_method == 2) {
                       echo 'SSL Commmerce';
                    }else{
                        echo "Stripe";
                    }

                    @endphp
                    </td>

				</tr>
                <tr>
                    <td></td>
                </tr>

				<tr class="heading">
					<td>Item</td>
                    <td>Qty</td>
					<td>Price</td>
                    <td>Sub-Total</td>
				</tr>
                @foreach ($prod_details as $prod)
				<tr class="item">
                    <td>{{$prod->rel_to_products->product_name}}</td>
                    <td>{{$prod->quantity}}</td>
                    <td>{{$prod->product_price}}</td>
					<td>{{($prod->product_price)*($prod->quantity)}}</td>
                </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Discount: - {{$orders->first()->discount}}</b>
                        </td>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Delivery Charge: +{{$orders->first()->delivery_charge}}</b></td>
                    </tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><hr><b>Grand-Total: {{$orders->first()->total}}</b></td>
				</tr>
			</table>
		</div>
	</body>
</html>
