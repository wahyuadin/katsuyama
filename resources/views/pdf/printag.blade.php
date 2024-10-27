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
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .page_break {
            page-break-before: always;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
    </style>
</head>

<body style="padding:5%">
    @foreach ($data as $dataItem)
        <table style="border-collapse:collapse; width: 100%;" cellspacing="0">
            <tr style="height:15pt">
                <td style="width:376pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3" rowspan="2">
                    <p class="s1" style="padding-top: 20pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                        <b>PROSES TAG</b>
                    </p>
                </td>
                <td
                    style="width:50pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;">
                    <p class="s1" style="text-indent: 0pt;line-height: 13pt;text-align: center;"><b>FIFO</b></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:50pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="margin-top: 30%"></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:74pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Date</b></p>
                </td>
                <td style="width:352pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    @isset($dataItem->loading->planing->tanggal)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->loading->planing->tanggal }}</p>
                    @endisset
                    @isset($dataItem->packing->loading->planing->tanggal)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->packing->loading->planing->tanggal }}</p>
                    @endisset
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:74pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Part No</b>
                    </p>
                </td>
                <td style="width:352pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    @isset($dataItem->loading->planing->part_no)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->loading->planing->part_no }}</p>
                    @endisset
                    @isset($dataItem->packing->loading->planing->part_no)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->packing->loading->planing->part_no }}</p>
                    @endisset
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:74pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Part Name</b></p>
                </td>
                <td style="width:352pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    @isset($dataItem->loading->planing->part_name)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->loading->planing->part_name }}</p>
                    @endisset
                    @isset($dataItem->packing->loading->planing->part_name)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->packing->loading->planing->part_name }}</p>
                    @endisset
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:74pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Proses</b>
                    </p>
                </td>
                <td
                    style="width:184pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                        {{ $dataItem->proses ? $dataItem->proses : '-' }}</p>
                </td>
                <td
                    style="width:50pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center;margin-top:5px; margin-bottom:5px">
                        <b>PIC</b></p>
                </td>
                <td
                    style="width:118pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="margin-left: 1%; margin-top: 5px; margin-bottom: 5px">
                        {{ \App\Models\User::where('nama', $dataItem->proses)->value('role') ? 'Operator ' . ucwords(\App\Models\User::where('nama', $dataItem->proses)->value('role')) : '-' }}
                    </p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td
                    style="width:74pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Next Proses</b></p>
                </td>
                <td
                    style="width:184pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                        {{ $dataItem->next_proses ? $dataItem->next_proses : '-' }}</p>
                </td>
                <td
                    style="width:50pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 13pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>PIC</b></p>
                </td>
                <td
                    style="width:118pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                        {{ \App\Models\User::where('nama', $dataItem->next_proses)->value('role') ? 'Operator ' . ucwords(\App\Models\User::where('nama', $dataItem->next_proses)->value('role')) : '-' }}
                    </p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:258pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 14pt;text-align: center; margin-top:5px; margin-bottom:5px">
                        <b>Lot No</b></p>
                </td>
                <td style="width:168pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s1"
                        style="padding-left: 2pt;text-indent: 0pt;line-height: 14pt;text-align: center; margin-top:3px; margin-bottom:5px">
                        <b>Qty</b></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:258pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    @isset($dataItem->packing->loading->lot_no)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->packing->loading->lot_no }}</p>
                    @endisset
                    @isset($dataItem->loading->lot_no)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">{{ $dataItem->loading->lot_no }}</p>
                    @endisset
                </td>
                <td style="width:168pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    @isset($dataItem->packing->loading->planing->qty)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->packing->loading->planing->qty }}</p>
                    @endisset
                    @isset($dataItem->loading->planing->qty)
                        <p style="margin-left: 1%; margin-top:5px; margin-bottom:5px">
                            {{ $dataItem->loading->planing->qty }}</p>
                    @endisset
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:258pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
                <td style="width:168pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left; margin-top:5px; margin-bottom:5px"><br /></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:258pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
                <td style="width:168pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left; margin-top:5px; margin-bottom:5px"><br /></p>
                </td>
            </tr>
            <tr style="height:15pt">
                <td style="width:258pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s1"
                        style="padding-left: 1pt;text-indent: 0pt;line-height: 14pt;text-align: center;margin-top:15px; margin-bottom:15px">
                        <b>Total</b></p>
                </td>
                <td style="width:168pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left; margin-top:10px; margin-bottom:10px"><br /></p>
                </td>
            </tr>
        </table>
    @endforeach
</body>

</html>
