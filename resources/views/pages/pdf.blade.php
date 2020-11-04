<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contract</title>
   <style type="text/css">
      @page {
         size: A4;
         margin-left: 1in;
         margin-right: 1in;
         margin-top: 0.5in;
         margin-bottom: 0.43in;
      }

      p {
         margin-bottom: 0in;
         direction: ltr;
         widows: 2;
         orphans: 2;
      }

      p.western {
         font-family: ".VnTime", serif;
      }

      p.cjk {
         font-family: "Times New Roman";
      }

      p.ctl {
         font-family: "Arial Unicode MS";
         font-size: 10pt;
      }

      h1 {
         margin-bottom: 0.04in;
         direction: ltr;
         widows: 2;
         orphans: 2
      }

      h1.western {
         font-family: "Arial", serif;
         font-size: 11pt;
      }

      h1.cjk {
         font-family: "PMingLiU";
         font-size: 11pt;
      }

      h1.ctl {
         font-family: "Arial";
         font-size: 11pt;
      }

      h6 {
         text-indent: 0.5in;
         margin-top: 0in;
         margin-bottom: 0in;
         direction: ltr;
         text-align: justify;
         widows: 2;
         orphans: 2;
      }

      h6.western {
         font-family: ".VnTimeH", serif;
         font-size: 10pt;
         font-style: italic;
      }

      h6.cjk {
         font-family: "Times New Roman";
         font-size: 10pt;
         font-style: italic;
      }

      h6.ctl {
         font-family: "Arial Unicode MS";
         font-size: 10pt;
         font-style: italic;
      }

      a:link {
         color: #0000ff;
      }

      li {
         margin: 8px 0;
      }
   </style>
</head>

<body>
   <p style="margin-bottom: 0.93in; display:flex; flex-direction: row-reverse">
      <img src="{{ public_path().'/images/watermark.png' }}" width="136" height="92"><br>
   </p>
   <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.92in; widows: 0; orphans: 0">
      <b>MANAGEMENT ASSOCIATEFINANCIAL ADVISOR AGREEMENT</b>
   </p>
   <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.5in; widows: 0; orphans: 0">
      <b>PRUDENTIAL MYANMAR LIFE INSURANCE LIMITED </b>
   </p>
   <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.5in; widows: 0; orphans: 0">
      <b>and</b>
   </p>
   <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 3.42in; widows: 0; orphans: 0">
      <b>{{ strtoupper($applicant->name ?? '') }}</b>
   </p>
   <p class="western" align="CENTER">Agreement No: {{ $applicant->agreement_no ?? '' }}</p>
   <div>
      <p class="western" style='overflow:hidden;page-break-before:always;'>
         <span style="text-transform: uppercase">
            Table of Contents
         </span>
      </p>
      <p>
         <ol>
            <li>APPOINTMENT AND AUTHORIZATION</li>
            <li>OBLIGATIONS OF FINANCIAL ADVISOR</li>
            <li>PROHIBITIONS</li>
            <li>COLLECTION AND REMITTANCE OF FUNDS</li>
            <li>COMPENSATION</li>
            <li>POLICY DELIVERY</li>
            <li>BOOKS AND RECORDS</li>
            <li>TERM AND TERMINATION</li>
            <li>CONDUCT BEFORE AND AFTER TERMINATION</li>
            <li>ASSIGNMENT</li>
            <li>FORCE MAJEURE</li>
            <li>ANTI-BRIBERY AND ANTI-MONEY LAUNDERING</li>
            <li>FRAUD REPORTING</li>
            <li>CONFIDENTIALITY</li>
            <li>SEVERABILITY</li>
            <li>GENERAL</li>
         </ol>
      </p>
   </div>
   <div>
      <p style='overflow:hidden;page-break-before:always;'>
         This &nbsp;Financial Advisor&nbsp;Agreement (&ldquo;Agreement&rdquo;)&nbsp;is made on the
         <b>{{ $applicant->signed_date ?? '' }}</b> by and between,
      </p>
      <p>Prudential Myanmar Life Insurance Limited, a private limited company incorporated under the laws of the
         Republic of the Union of Myanmar, having its address at # 15-01, 15<sup>th</sup>&nbsp;Floor, Sule Square,
         221 Sule Pagoda Road, Kyauktada Township, the Republic of the Union of Myanmar (hereinafter referred to as
         the &ldquo;Company&rdquo;)</p>
      <p>and</p>
      <p>{{ $applicant->name ?? '' }}, holding National Identity Card No.
         <b>{{ $applicant->nrc ?? '...........' }}</b>, residing at
         <b>{{ $applicant->address ?? '.................' }}</b> (hereinafter referred to as the &ldquo;Financial
         Advisor&rdquo;, &ldquo;Advisor&rdquo;)</p>
      <p>(Company and Advisor individually referred to as a &ldquo;Party&rdquo; and collectively referred to as the
         &ldquo;Parties&rdquo;)</p>
      <p>The Parties have agreed to enter into this Agreement under following terms and conditions:</p>

      <div>
         {!! $applicant->document !!}
      </div>

      <p class="western" align="JUSTIFY" style="margin-top: 0.17in; margin-bottom: 0.08in; page-break-before: always">
         <p><br /><strong><strong>IN WITNESS</strong></strong>&nbsp;whereof this Agreement has been executed by
            the Parties on the date first above written.</p>
         <table width="100%" border="0">
            <tbody>
               <tr>
                  <td width="50%" valign="top">
                     <p>For and on behalf of the Company</p>
                     <p><em><em>Signature</em></em></p>
                     @if(!empty($contractor_signature))
                     <img src="{{ public_path().'/storage/'.$applicant->contractor_signature->image }}" width="136"
                        height="92" />
                     @else
                     <div style="height:95px"></div>
                     @endif
                  </td>
                  <td width="50%" valign="top">
                     <p>The Advisor</p>
                     <p><em><em>Signature</em></em></p>
                     <p>
                        <img src="{{ public_path().'/storage/'.$applicant->applicant_sign_img }}" width="136"
                           height="92" />
                     </p>
                  </td>
               </tr>
               <tr>
                  <td width="50%" valign="top">
                     @if(!empty($contractor_signature))
                     <p>Name: {{ $applicant->contractor_signature->name}}</p>
                     <p>Title: {{ $applicant->contractor_signature->title }}</p>
                     @endif
                  </td>
                  <td width="50%" valign="top">
                     <p>Name: {{ $applicant->name }}</p>
                  </td>
               </tr>
               <tr>
                  <td width="50%" valign="top">
                     @if(!empty($witness_signature))
                     <p>Witness</p>
                     <p><em><em>Signature</em></em></p>
                     <img src="{{ public_path().'/storage/'.$applicant->witness_signature->image }}" width="136"
                        height="92">
                     @endif
                  </td>
                  <td width="50%" valign="top">
                     <p>Witness</p>
                     <p><em><em>Signature</em></em></p>
                     <img src="{{ public_path().'/storage/'.$applicant->witness_sign_img }}" width="136" height="92">
                  </td>
               </tr>
               <tr>
                  <td width="50%" valign="top">
                     @if(!empty($witness_signature))
                     <p>Name: {{ $applicant->witness_signature->name }}</p>
                     <p>Title: {{ $applicant->witness_signature->title }}</p>
                     @endif
                  </td>
                  <td width="50%" valign="top">
                     <p>Name: {{ $applicant->witness_name }}</p>
                  </td>
               </tr>
            </tbody>
         </table>
         <p>&nbsp;</p>
         <!-- Contract Ends -->
   </div>
</body>

</html>