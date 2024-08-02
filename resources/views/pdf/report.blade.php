<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="author" content="Wahyu Adi Nugraha" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        .s1 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 14pt;
        }

        .s2 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s3 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
    </style>
</head>

<body style="padding: 5%;">
    <table style="border-collapse:collapse;margin-left:6.73pt; width: 100%;" cellspacing="0">
        <tr style="height:16pt">
            <td rowspan="2" colspan="1"
                style="width:27pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt">
                <p style="text-indent: 0pt;text-align: left;">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img width="124" height="86"
                                    src="data:image/png;base64,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" />
                            </td>
                        </tr>
                    </table>
                </p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:315pt;border-top-style:solid;border-top-width:2pt" colspan="6">
                <p class="s1" style="padding-left: 100pt;text-indent: 0pt;line-height: 16pt;text-align: center;">
                    OPERATION DAILY REPORT EDP <br>LOADING &amp; PACKING</p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:75pt;border-top-style:solid;border-top-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td
                style="width:65pt;border-top-style:solid;border-top-width:2pt;">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td
                style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;text-align: center;"><b>Disetujui</b></p>
            </td>
            <td
                style="width:68pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;text-align: center;"><b>Diperiksa</b></p>
            </td>
        </tr>
        <tr style="height:60pt">
            <td style="width:27pt;">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:27pt;">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:79pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:186pt" colspan="4">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:50pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:50pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:75pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:65pt;border-right-style:solid;border-right-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td
                style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td
                style="width:68pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:46pt">
            <td style="width:781pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                colspan="14">
                <p style="text-indent: 0pt;text-align: left;"><span></span></p>
                <p class="s3" style="padding-left: 4pt;padding-right: 719pt;text-indent: 0pt;line-height: 113%;text-align: left; margin-top: 5%; margin-bottom: 5px;">Machine : </p>
                <p class="s3" style="padding-left: 4pt;padding-right: 719pt;text-indent: 0pt;line-height: 113%;text-align: left; margin-bottom: 10px;">Operator :</p>
            </td>
        </tr>
        <tr style="height:17pt">
            <td style="width:451pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt"
                colspan="9">
                <p class="s2" style="padding-left: 1pt;text-indent: 0pt;text-align: center;">Operator Loading</p>
            </td>
            <td style="width:330pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:2pt"
                colspan="5">
                <p class="s2" style="padding-left: 1pt;text-indent: 0pt;text-align: center;">Operator Packing</p>
            </td>
        </tr>
        <tr style="height:15pt">
            <td style="width:27pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">No</p>
            </td>
            <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">Tanggal
                </p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">Part No
                </p>
            </td>
            <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">Part
                    Name</p>
            </td>
            <td style="width:40pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">Lot No
                </p>
            </td>
            <td style="width:96pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                colspan="2">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">
                    Hangger</p>
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">QTY In
                </p>
            </td>
            <td style="width:100pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                colspan="2">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">
                    Time</p>
            </td>
            <td style="width:75pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">Lot No
                    EDP</p>
            </td>
            <td style="width:65pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">QTY
                    OK</p>
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">QTY
                    NG</p>
            </td>
            <td style="width:68pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt"
                rowspan="2">
                <p class="s2" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">
                    Remark</p>
            </td>
        </tr>
        <tr style="height:15pt">
            <td
                style="width:49pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">Type
                </p>
            </td>
            <td
                style="width:47pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">QTY
                </p>
            </td>
            <td
                style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">In
                </p>
            </td>
            <td
                style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p class="s2" style="text-indent: 0pt;line-height: 13pt;text-align: center;">Out
                </p>
            </td>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $dataItem)
        <tr style="height:15pt">
            <td
                style="width:27pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                <p style="text-indent: 0pt;text-align: center;">{{ $no++ }}</p>
            </td>
            <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->planing->tanggal)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->planing->tanggal }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;"><br></p>
                @endisset
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->planing->part_no)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->planing->part_no }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->planing->part_name)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->planing->part_name }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:40pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->lot_no)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->lot_no }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:49pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->hanger->type)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->hanger->type }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:47pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->hanger->qty)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->hanger->qty }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->qty_in)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->qty_in }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->loading->time_in)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->loading->time_in }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:50pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->packing->time_out)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->packing->time_out }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:75pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->packing->lot_no_edp)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->packing->lot_no_edp }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:65pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->packing->qty_ok)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->packing->qty_ok }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->packing->qty_ng)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->packing->qty_ng }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
            <td style="width:68pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                @isset($dataItem->packing->remark)
                    <p style="text-indent: 0pt;text-align: center;">{{ $dataItem->packing->remark }}</p>
                @else
                    <p style="text-indent: 0pt;text-align: center;">-</p>
                @endisset
            </td>
        </tr>
        @endforeach
    </table>
    <table style="border-collapse:collapse;margin-left:3pt" cellspacing="0">
        <tr style="height:16pt">
            <td style="width:62pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:15pt">
            <td style="width:62pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
    </table>
    <p style="text-indent: 0pt;text-align: left;" />
</body>

</html>
