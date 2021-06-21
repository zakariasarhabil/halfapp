<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> Real State {{ $id }} </title>

		<style>

            body {
                font-family: 'XBRiyaz', sans-serif;
            }
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'XBRiyaz', sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
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

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'XBRiyaz', sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}

            @page {
	    header: page-header;
	    footer: page-footer;
        }

		</style>
	</head>

	<body>
		<div class="invoice-box rtl">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="https://2andhalf.com/wp-content/uploads/2021/04/logo.png" style="width: 100%; max-width: 100px; 	background-color: #333 !important;" />
								</td>

								<td>
									رقم العرض : {{ $id }}<br />
									تاريخ العرض: {{ $created_at }}<br />
									اسم مدخل العرض:  {{ $creator }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							{{-- <tr>
								<td>
									Sparksuite, Inc.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

								<td>
									Acme Corp.<br />
									John Doe<br />
									john@example.com
								</td>
							</tr> --}}
						</table>
					</td>
				</tr>

				{{-- <tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr> --}}
{{--
				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr> --}}

				{{-- <tr class="heading">
					<td>Item</td>

					<td>Price</td>
				</tr> --}}

				<tr class="item">
					<td>نوع العرض</td>

					<td>{{$type_offer }} </td>
				</tr>

				<tr class="item">
					<td>نوع العقار</td>

					<td> {{ $type_RealState}} </td>
				</tr>

                <tr class="item">
					<td> المساحة </td>

					<td> {{ $space }} </td>
				</tr>

                <tr class="item">
					<td>السعر</td>

					<td> {{ $price }} </td>
				</tr>

                <tr class="item">
					<td>سعر المتر</td>

					<td> {{ $price_meter }} </td>
				</tr>

                <tr class="item">
					<td>الواجهة</td>

					<td>{{$facade}}</td>
				</tr>

                <tr class="item">
                    <td>الموقع</td>

                    <td> {{ $location }} </td>
                </tr>

                <tr class="item">
					<td>تقييم العقار</td>

                    @if ($evaluation == 1)
                    <td>
                        @include('star')
                    </td>

                    @elseif($evaluation == 2)

                    <td>
                        @include('star')
                        @include('star')
                    </td>

                    @elseif($evaluation == 3)
                    <td>
                        @include('star')
                        @include('star')
                        @include('star')
                    </td>

                    @elseif($evaluation == 4)
                    <td>
                        @include('star')
                        @include('star')
                        @include('star')
                        @include('star')
                    </td>


                    @elseif($evaluation == 5)
                    <td>
                        @include('star')
                        @include('star')
                        @include('star')
                        @include('star')
                        @include('star')
                    </td>

                    @endif
				</tr>


                <tr class="item">
					<td>عمر العقار</td>

					<td> {{ $age }} </td>

				</tr>



	        <tr class="item">
					<td>عدد الشقق</td>

					<td> {{ $number_apartment }} </td>
				</tr>

                <tr class="item">
					<td>مؤثث</td>

					<td> {{ $furnished }} </td>
				</tr>

                <tr class="item">
					<td>دبلكس</td>

					<td> {{ $duplex }} </td>
				</tr>

                <tr class="item">
					<td>غرفة سائق</td>

					<td> {{ $driver_room }} </td>
				</tr>

                <tr class="item">
					<td>ملحق</td>

					<td> {{ $addition }} </td>
				</tr>

                <tr class="item">
					<td>قبو</td>

					<td> {{ $cellar }} </td>
				</tr>

                <tr class="item">
					<td>مصعد</td>

					<td> {{ $elevator }} </td>
				</tr>

                <tr class="item">
					<td>مسبح</td>

					<td> {{ $magnifier }} </td>
				</tr>

				<tr class="item">
					<td>نوع الارض</td>

					<td> {{ $earth_type }} </td>
				</tr>

                <tr class="item">
					<td>الدخل السنوي</td>

					<td> {{ $annual_income }} </td>
				</tr>


                <tr class="item">
					<td>مواصفات أخرى</td>

					<td> {{ $specification }} </td>
				</tr>


                <tr class="item">
					<td>عدد المكاتب</td>

					<td> {{ $number_offices }} </td>
				</tr>


                <tr class="item">
					<td>نوع المالك</td>

					<td> {{ $type_owner }} </td>
				</tr>


                <tr class="item">
					<td>الاسم</td>

					<td> {{ $name_owner }} </td>
				</tr>



                <tr class="item">
					<td>جوال</td>

					<td> {{ $phone }} </td>
				</tr>



                <tr class="item">
					<td>جوال آخر</td>

					<td> {{ $phone_two }} </td>
				</tr>








			</table>
		</div>
	</body>
</html>
