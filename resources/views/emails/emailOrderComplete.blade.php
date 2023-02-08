<div style="background-color:white">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" dir="ltr"
        style="font-size:16px;background-color:rgb(223,228,234)">

        <tbody>
            <tr>
                <td align="center" valign="top" style="margin:0;padding:5px 0 10px">

                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600"
                        style="width:600px">
                        <tbody>

                            <tr>
                                <td valign="top" align="left" bgcolor="#ffffff" style="padding:0;margin:0">
                                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="left"
                                                    style="padding:20px 35px 15px 45px;margin:0px;line-height:1.75;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif">
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:28px;font-weight:700;color:#000000;line-height:1.7">
                                                        XIN CHÀO <br><span
                                                            style="color:#ba1f25">{{ $purchaseOrder->name }}</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top" align="left" bgcolor="#ffffff" style="padding:0;margin:0">
                                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="left"
                                                    style="padding:0px 15px 10px 15px;margin:0px;line-height:1.75;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif">
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:17px;font-weight:400;color:#000000;line-height:1.7">
                                                        Cảm ơn bạn đã tin tưởng mua hàng tại SHOP Q.
                                                    </span>
                                                    <p></p>
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:17px;font-weight:400;color:#000000;line-height:1.7">
                                                        Mã đơn hàng:
                                                        <span style="color:#ba1f25">{{ $purchaseOrder->code }}</span>
                                                        Ngày mua:
                                                        <span style="color:#ba1f25">
                                                            {{ $purchaseOrder->created_at }}
                                                        </span>
                                                        Thông tin chi tiết đơn hàng của bạn như sau:
                                                    </span>
                                                    <p></p>
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:17px;font-weight:400;color:#000000;line-height:1.7">
                                                        <table cellpadding="3" cellspacing="1"
                                                            style="width:100%;background:#ba1f25">
                                                            <thead>
                                                                <tr style="height:40px;font-weight:bold;color:white">
                                                                    <th
                                                                        style="width:40%;font-size:12px;text-align:center;background-image:linear-gradient(to right,#ba1f25)">
                                                                        SẢN PHẨM</th>
                                                                    <th
                                                                        style="width:5%;font-size:12px;text-align:center;background-image:linear-gradient(to right,#ba1f25)">
                                                                        SỐ LƯỢNG</th>
                                                                    <th
                                                                        style="width:15%;font-size:12px;text-align:center;background-image:linear-gradient(to right,#ba1f25)">
                                                                        GIÁ</th>


                                                                    <th
                                                                        style="width:20%;font-size:12px;text-align:center;background-image:linear-gradient(to right,#ba1f25)">
                                                                        THÀNH TIỀN</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($products as $product)
                                                                    <tr style="background:#fff">
                                                                        <td align="center"
                                                                            style="display:flex; justify-content: space-between;">
                                                                            <img src="{{ $product->thumb }}"
                                                                                alt="Hình ảnh vé"
                                                                                style="width:100px;height:100px"
                                                                                class="CToWUd" data-bit="iit">
                                                                            <span>{{ $product->name }}</span>
                                                                            &nbsp; x
                                                                            <span>{{ $product->size }}</span>
                                                                        </td>
                                                                        <td align="center">{{ $product->quantity }}</td>
                                                                        <td align="center"
                                                                            style="text-decoration:none;color:#0a8af1">
                                                                            <span>{{ number_format($product->price, 0, '', '.') }}đ</span>
                                                                        </td>
                                                                        <td align="center">
                                                                            {{ number_format($product->total_price, 0, '', '.') }}đ
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </span>
                                                    <p></p>
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:17px;font-weight:400;color:#000000;line-height:1.7">
                                                        Đơn hàng sẽ được chuẩn bị và gửi đến bạn khoảng từ 5-7 ngày.
                                                        Hình thức thanh toán: nhận hàng mới thanh toán.
                                                        Một lần nữa SHOP Q xin chân thành cảm ơn vì bạn đã yêu thích sản
                                                        phẩm bên shop.

                                                    </span>

                                                    <p></p>
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:17px;font-weight:400;color:#000000;line-height:1.7">
                                                        Chúc bạn một ngày tốt lành và hạnh phúc. Xin chân thành cảm ơn.
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#ffffff" valign="top" align="left" style="padding:0;margin:0">
                                    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="center"
                                                    style="padding:20px;margin:0px;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif;line-height:1.15">
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#e32e35;line-height:1.1;font-style:normal">
                                                        Bạn có thể tiếp tục mua sắm với những ưu đãi khủng tại đây !
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" bgcolor="#ffffff" style="margin:0;padding:0px 0 10px">
                                    <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="padding:0px;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif;line-height:1.15">
                                                    <div
                                                        style="width:100%;margin-top:0px;margin-bottom:0px;text-align:center">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            align="center"
                                                            style="padding-bottom:0px;padding-top:0px;margin:0px auto">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center"
                                                                        style="display:inline-block;padding:15px 65px;background-color:#ba1f25;border-radius:5px">
                                                                        <a href="https://shopq-production.up.railway.app/"
                                                                            style="font-family:Arial,Helvetica,sans-serif;color:#ffffff;font-size:15px;text-decoration:none;font-weight:700"
                                                                            target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://shopq-production.up.railway.app/&amp;source=gmail&amp;ust=1667032212581000&amp;usg=AOvVaw3sEtsgwzG7nqrWVn1aqpkv">
                                                                            TIẾP TỤC MUA SẮM
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" bgcolor="#ffffff" style="margin:0;padding:10px">
                                    {{-- <img width="100%"
                                        src="https://ci3.googleusercontent.com/proxy/XEPx6_Tb75h2ZQS-WsciNNH2l3JpAkwLLvegMMuI0q1YcGxu6q1sSrHMOCQHIZsKn8FoNoZlyVV8ueUnL8MoXB8dK5Z7tNlAYQnF1aH5Jg=s0-d-e1-ft#https://webapi.mobilott.vn/Assets/Images/emailwelcome_03.png"
                                        class="CToWUd" data-bit="iit"> --}}
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#ffffff" valign="top" align="left" style="padding:0;margin:0">
                                    <table align="center" width="100%" border="0" cellpadding="0"
                                        cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td bgcolor="#ffffff" valign="top" align="center"
                                                    style="margin:0px;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif;line-height:1.15">
                                                    <span
                                                        style="font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#25335c;line-height:1.1;font-style:normal">
                                                        Liên hệ với chúng tôi
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" bgcolor="#ffffff"
                                    style="margin:0;padding:20px 0 50px">
                                    <table border="0" cellpadding="0" cellspacing="0" align="center"
                                        width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="padding:0px;background-color:rgb(255,255,255);font-size:16px;font-family:'Times New Roman',Times,serif;line-height:1.15">
                                                    <div style="display:flex">
                                                        <div
                                                            style="width:100%;margin-top:0px;margin-bottom:0px;text-align:center">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                align="center"
                                                                style="padding-bottom:0px;padding-top:0px;margin:0px auto">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="display:inline-block;margin:0px;padding:0px 0px 50px;font-family:Verdana,sans-serif;color:rgb(55,55,55);font-size:14px">
                                                                            <a title=""
                                                                                style="text-decoration:none">
                                                                                <img src="https://ci6.googleusercontent.com/proxy/mgEaHPmcGv4W3emZabi49DUVyUu-MlYLIS6bEbsvNj-bYpczWIu2J92bat-PnIl272cNIhS8HygWO5haKEaxV89Z7K93d_PPRWaaMGDIMw=s0-d-e1-ft#https://webapi.mobilott.vn/Assets/Images/emailwelcome_09.png"
                                                                                    alt="" width="50"
                                                                                    height="50" border="0"
                                                                                    style="border-width:0px;border-style:none;border-color:transparent;font-size:12px;display:block"
                                                                                    class="CToWUd" data-bit="iit">
                                                                            </a>
                                                                            <a href="mailto:shopqcontact@gmail.com"
                                                                                target="_blank">shopqcontact@gmail.com</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div
                                                            style="width:100%;margin-top:0px;margin-bottom:0px;text-align:center">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                align="center"
                                                                style="padding-bottom:0px;padding-top:0px;margin:0px auto">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="display:inline-block;margin:0px;padding:0px 0px 50px;font-family:Verdana,sans-serif;color:rgb(55,55,55);font-size:14px">
                                                                            <a title=""
                                                                                style="text-decoration:none">
                                                                                <img src="https://ci3.googleusercontent.com/proxy/rV_9WhZENQefC4lPbljJH9ZHigEtNwFTq6QkK5NdIAD_GX7KfrbDE6uiS5NCOvLcA2WEsieGAxkiHcHfmgnyCgMbnYId-jGnfZMFPutw9A=s0-d-e1-ft#https://webapi.mobilott.vn/Assets/Images/emailwelcome_10.png"
                                                                                    alt="" width="50"
                                                                                    height="50" border="0"
                                                                                    style="border-width:0px;border-style:none;border-color:transparent;font-size:12px;display:block"
                                                                                    class="CToWUd" data-bit="iit">
                                                                            </a>
                                                                            +84 123456789
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div
                                                            style="width:100%;margin-top:0px;margin-bottom:0px;text-align:center">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                align="center"
                                                                style="padding-bottom:0px;padding-top:0px;margin:0px auto">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="display:inline-block;margin:0px;padding:0px 0px 50px;font-family:Verdana,sans-serif;color:rgb(55,55,55);font-size:14px">
                                                                            <a title=""
                                                                                href="https://www.facebook.com/Luckylotter.vn"
                                                                                style="text-decoration:none"
                                                                                target="_blank"
                                                                                data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/Luckylotter.vn&amp;source=gmail&amp;ust=1667032212582000&amp;usg=AOvVaw1tclehLQQotb8IFj4418z4">
                                                                                <img src="https://ci5.googleusercontent.com/proxy/YWYIZjlP_3wHo1rPpNdG7S67OAHSqktnUtUyDNtO3qktPt5gWBu6E1mYBs9ZNH0S51kjmKam9SaA9cdvaP3BXm9mBYxqW32a0yKfCLDwBg=s0-d-e1-ft#https://webapi.mobilott.vn/Assets/Images/emailwelcome_11.png"
                                                                                    alt="" width="50"
                                                                                    height="50" border="0"
                                                                                    style="border-width:0px;border-style:none;border-color:transparent;font-size:12px;display:block"
                                                                                    class="CToWUd" data-bit="iit">
                                                                            </a>
                                                                            https://shopq-production.up.railway.app
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top" bgcolor="#ffffff"
                                                    style="margin:0;padding:20px;border-top:2px solid #ba1f25">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>

    </table>
</div>
