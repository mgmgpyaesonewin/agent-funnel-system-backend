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
      <b>[Name of Management AssociateFinancial Advisor]</b>
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
            <li>ORCE MAJEURE</li>
            <li>ANTI-BRIBERY AND ANTI-MONEY LAUNDERING</li>
            <li>FRAUD REPORTING</li>
            <li>CONFIDENTIALITY</li>
            <li>SEVERABILITY</li>
            <li>GENERAL</li>
         </ol>
      </p>
   </div>
   <p class="western" style="margin-bottom: 0.42in; line-height: 200%"><br><br></p>
   <p class="western" align="JUSTIFY" style="margin-top: 0.17in; margin-bottom: 0.08in"><br><br></p>
   <p class="western" align="JUSTIFY" style="margin-top: 0.17in; margin-bottom: 0.08in; page-break-before: always">
      <div>
         <p>This &nbsp;Financial Advisor&nbsp;Agreement (&ldquo;Agreement&rdquo;)&nbsp;is made on the
            <b>{{ $applicant->signed_date ?? '' }}</b> by and between,</p>
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
         <ol style="list-style-type:none;margin:0px;padding:0px;">
            <h2>
               <li>1. APPOINTMENT AND AUTHORIZATION&nbsp;</li>
               </h1>
               <ol style="list-style-type:none;">
                  <li>1.1 Subject to the terms and conditions of this Agreement and upon the date of its signing, the
                     Company agrees to authorize the Advisor, and the Advisor&nbsp;agrees to accept such authorization,
                     to carry out insurance consulting business to present, solicit, provide information, consult with
                     and to help prospects to submit proper application forms for insurance products offered by the
                     Company&nbsp;to the designated offices of the Company, and&nbsp;the Advisor&nbsp;is authorized by
                     the Company under the scope of operation of this Agreement to serve the needs and requirements of
                     the policy owners of insurance policies issued by the Company ("Policy owner" and "Policy") during
                     the term of this Agreement.</li>
                  <li>1.2 During the term of this Agreement, the Advisor&nbsp;agrees and undertakes to only represent
                     the Company under the scope of authorization stated under the terms of this Agreement. &nbsp;</li>
                  <li>1.3 The&nbsp;Advisor&nbsp;may operate anywhere within the territory of the Republic of the Union
                     of Myanmar ("Myanmar") as the Company may decide from time to time, but no exclusive right in any
                     district in Myanmar is assigned to the Advisor. The Company also has the right to assign the
                     Advisor to any specific location within Myanmar.</li>
                  <li>1.4 The Advisor&nbsp;is not authorized and shall not have the power or authority to bind the
                     Company or incur any liability or obligation, or act on behalf of the Company. While the Company is
                     entitled to provide the Advisor with general guidance to assist the Advisor &nbsp;in completing the
                     scope of work to the Company&rsquo;s satisfaction, the Advisor&nbsp;is ultimately responsible for
                     directing and controlling the performance of the task and the scope of work, in accordance with the
                     terms and conditions of this Agreement.</li>
                  <li>1.5 Nothing contained herein shall require or be construed as requiring the Company to accept any
                     application from any person presented by the Advisor.</li>
                  <li>1.6 In consideration for the Advisor&nbsp;performing his/her obligations under this Agreement, the
                     Company agrees to pay the compensation as Commission and Bonus&nbsp;under this Agreement as
                     specified in the Financial Advisor Compensation Scheme issued and amended by&nbsp;the Company from
                     time to time ("Financial Advisor Compensation Scheme").</li>
                  <li>1.7 For the purposes of the calculation of the Financial Advisor Compensation Scheme, the date of
                     execution of this Agreement&nbsp;by the Advisor and the Company shall for the purpose of this
                     provision only be treated as the date of appointment of the Advisor , and the Financial Advisor
                     Compensation Scheme&nbsp;shall not be payable by the Company unless and until the Advisor &nbsp;has
                     completed the requisite training courses provided by the Company and the relevant Regulatory
                     Authorities including not limited to Financial Regulatory Department, Insurance Business Regulatory
                     Board and Myanmar Insurance Association (&ldquo;Regulators&rdquo;) and have passed the required
                     examinations set by the said Regulators.</li>
                  <li>1.8 Unless otherwise specified, the Advisor shall report to a designated Supervisor
                     (&ldquo;Supervisor&rdquo;), who would be a member of staff appointed by the Company. The Company
                     will have the sole discretion in appointing such Supervisor. In case the Advisor &nbsp;assists a
                     potential prospect to submit an insurance application to the Company, such application must be
                     first signed by the appointed Supervisor, which would also be a pre-condition for acceptance of the
                     application form by the Company.</li>
               </ol>
               <h2>
                  <li>2. OBLIGATIONS OF ADVISOR </li>
               </h2>
               <ol style="list-style-type:none;">
                  <li>2.1 The Advisor shall comply with, at all times:</li>
                  <ol type="a">
                     <li>all laws and regulations of Myanmarand judgments of the courts of Myanmar and any relevant
                        arbitral awards in Myanmar;</li>
                     <li>any code of conduct for the Advisorissued by the Company; and</li>
                     <li>professional guidelines, policies applicable tothe Advisor&nbsp;or regulations set out by the
                        Company,&nbsp;or relevant authorities including but not limited to the Financial Regulatory
                        Department, Insurance Business Regulatory Board and Myanmar Insurance Association that may in
                        the future come into effect and be amended from time to time.
                  </ol>
                  <li>2.2 The Advisor shall:</li>
                  <ol type="a">
                     <li>carry out his/herobligations under this Agreement and always conduct his/her&nbsp;authorized
                        assignments under the appointment of the Agreement with professionalism, fairness, integrity and
                        honesty;</li>
                     <li>employ his/herskills and expertise to the best of his abilities, experiences, and knowledge;
                     </li>
                     <li>report or provide to the Supervisor and the Company any information he/she, to the best of
                        his/herability, knowledge, and prudence, considers necessary or relevant
                        to&nbsp;the&nbsp;insurance business or business risks of the Company;</li>
                     <li>continue to provide after-salesservices to Policy&nbsp;owners and their beneficiaries&nbsp;as
                        instructed by the Company from time to time;&nbsp;and</li>
                     <li>provide full and clear information about his/herroles and scope of authorization to avoid any
                        confusion from any&nbsp;prospective Policy owners, customers, or any other third parties.
                  </ol>
                  <li>2.3 The Advisor shall ask any insured persons (prospective or otherwise) to have a medical
                     examination, if required, at clinics nominated by the Company only, unless otherwise agreed or
                     allowed in writing by the Company. In case the Advisor asks any insured person (prospective or
                     otherwise) to have a medical examination at any clinic, other than those nominated by the Company,
                     the Advisor &nbsp;shall be responsible for such medical examination cost and the results thereof
                     shall not be recognized by the Company.</li>
                  <li>2.4 The Advisor must clearly inform customers of his/her own liabilities to the accuracy of
                     information contained in any document provided to customers, which are not issued by the Company;
                  </li>
               </ol>
               <li>
                  <h2>3. PROHIBITIONS</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>3.1 : The Advisor shall not:</li>
                  <ol type="a">
                     <li>sign any insurance document or Agreement on behalf of any party, with his authority confined to
                        onlyverifying to those signatures that are actually performed in their presence;</li>
                     <li>represent to any persons or third parties that he is authorized to accept notice of loss,
                        negotiate terms of settlement, settle or pay any loss or claim except where he is expressly
                        authorized to do so by the Company as stated in Clause 1.1;</li>
                     <li>conspireor induce any Policy owner or any other person to make any insurance claim of whatever
                        nature;</li>
                     <li>renew, extend, alter or reinstate any Policy on behalf of the Company;</li>
                     <li>amend, alter, add, delete, or substitute any such forms or documents or any documents belonging
                        to the Company or the Policy owner or the insured personfrom time to time;&nbsp;</li>
                     <li>endeavor or attempt to induce, whether directly or indirectly, any other Advisor or
                        representative of the Company to cease their business association with the Company or terminate
                        their engagement or services agreement&nbsp;&nbsp;with the Company;</li>
                     <li>make any statementor&nbsp;representation in written or verbal form which is to the Advisor
                        &rsquo;s knowledge untrue, false or unsubstantiated that prejudice or affect the Company's brand
                        name and credit;</li>
                     <li>mis-sell or makeany statement or representation in written or verbal form which is false in
                        order to induce any Policy owner (prospective or otherwise) to purchase any insurance product of
                        the Company, &nbsp;</li>
                     <li>publish or cause to be published any advertisement concerning the Company, other insurance
                        company, or insurance related company without the prior written authority of the Company; nor
                        shall the Advisorissue, distribute or cause to be issued any circular or to write or to cause to
                        be written any letters to any newspaper, magazine or publication in respect of the Company,
                        other insurance company, or insurance related company, without first obtaining the written
                        approval of the Company;&nbsp;&nbsp;</li>
                     <li>incur any liability on behalf of the Company, pledge or purport to pledge the Company's credit
                        or make any other Agreement binding upon the Company;</li>
                     <li>revise any documents issued by theCompany&rsquo;s;</li>
                     <li>print or circulate any advertisement or printed items related to the Company or its operations
                        without the Company&rsquo;s written approval;</li>
                     <li>on behalf of the Company, giveany information to the&nbsp;mass media through the or
                        on&nbsp;radio&nbsp;or&nbsp;television or to a crowd&nbsp;of persons&rsquo;;</li>
                     <li>use software illustrating insurance value, that is not provided by the Company.</li>
                     <li>participate in any case and dispute related to any Company&rsquo;s business without the
                        Company&rsquo;s written approval&rsquo;</li>
                     <li>act for any other companies, businesses, or agencies, whether directly or indirectly, during
                        the term of this Agreement, regardless of whether or not they operate a competing business with
                        the Company. (For the purpose of this provision, the Advisorhereby confirms and warrants that
                        he/she is not currently working for or engaged in any capacity by any other insurance
                        companies);</li>
                     <li>negotiate, enter into or cancel any agreement or accept any insurance risk on behalf of the
                        Company, issue any Policy, or bind the Company in any other manner;</li>
                     <li>represent or confirm to the Policy owner or any other person that he has been given
                        authorization to accept, or that the Company has accepted the application and/or issued the
                        Policy, unless prior notice in writing has been given by the Company;</li>
                     <li>give any assertion, assurance or promise relating to the endorsements of the Policy or
                        supplementary agreements issued by the Company unless authorized in writing by the Company from
                        time to time; or</li>
                     <li>engage any other Advisoror third party to undertake the assignments or duties authorized by the
                        Company under the terms and conditions of this Agreement during the term of this Agreement
                        without prior written approval from the Company.</li>
                  </ol>
                  <li>3.2 The breach of any provisions in this clause shall result in the suspension or termination of
                     this Agreement at the discretion of the Company. Any damage or loss as a result of such a violation
                     shall be at the sole liability of the Advisor.</li>
               </ol>
               <li>
                  <h2>4. COLLECTION AND REMITTANCE OF FUNDS</h2>
               </li>
               <p>The Advisor&nbsp;is not authorized to collect the premium or any fund from the Policy owner. The
                  Advisor&nbsp;shall not pay any premium or other payments required to be made on behalf of the Policy
                  owner&nbsp;or any other person&nbsp;to the Company.</p>
               <li>
                  <h2>
                     5. COMPENSATION</h1>
               </li>
               <ol style="list-style-type:none;">
                  <li>5.1 TheAdvisor's entitlement to the Commission&nbsp;items as mentioned in the Financial Advisor
                     Compensation Scheme&nbsp;is conditional upon:</li>
                  <ol type="i">
                     <li>the issuance by the Company of the Policy (including endorsements and supplementary Agreement s
                        where applicable) and the Policy remaining in force beyond any free lookback or cooling off
                        period under applicable laws and regulations or otherwise;</li>
                     <li>receipt by the Company of the relevant premiums from the Policy owner or any third party
                        authorized by the Policy owner;</li>
                     <li>compliance by the Advisorwith all provisions of this Agreement; and</li>
                     <li>the Advisor&rsquo;s name and personal identification code appearing on the Application.</li>
                  </ol>
                  <li>5.2 The Company shall, at its sole discretion, have the right to alter, amend, substitute or
                     delete any part or parts of Financial Advisor Compensation Schemewhether in full or part from time
                     to time, as notified by the Company to the Policy owner and any such any change shall be deemed to
                     take effect from the date of such notice. In any case, any amendments, substitution or deletion to
                     the Financial Advisor Compensation Scheme&nbsp;shall not affect the Compensation payable to the
                     Advisor&nbsp;prior to the effective date of such amendments, substitutions or deletion of the
                     Financial Advisor Compensation Scheme.</li>
                  <li>5.3 The Advisorshall only be entitled to any Compensation on the sale of any insurance product if
                     his/her name appears on the application form for such insurance product.</li>
                  <li>5.4 Whenever any Policy is changed or converted to another Policy plan, any compensation payable
                     upon the changed or converted Policy shall be determined by the rules of the Company in force at
                     the time of such change or conversion.</li>
                  <li>5.5 When any Policy is converted to another Policy plan which has a lower value, the Advisoris not
                     entitled to receive any compensation, fees or benefits from such Policies. &nbsp;</li>
                  <li>5.6 If the Company shall refund the premiums to the Policy owner and cancel the Policy, the
                     Advisorshall return to the Company the amount of Compensation received on the premiums refunded to
                     the Policy owner. The Company shall have sole right to deduct this amount prior to any payment to
                     the Advisor.</li>
                  <li>5.7 If the Company detects any fraud committed by the Advisor, including but not limited to
                     willfully misleading any the Policy owner (prospective or otherwise) in order to for the purpose of
                     making any claim for compensation, or leading to the suspension or termination of any Policy, the
                     Advisorshall repay to the Company any compensation received in connection with such Policy. The
                     Company shall have sole right to deduct these amounts prior to any payment to the Advisor&nbsp;and
                     take any actions in accordance with the Clause 8.3.</li>
                  <li>5.8 Upon the termination of this Agreement, the Advisor will cease to &nbsp;be entitled to any
                     compensation as per the then applicable and effective Financial Advisor Compensation Scheme,
                     irrespective of the Policies solicited by the Advisor which are in force at the time of the
                     termination.</li>
                  <li>5.9 The Company has the right to withhold or offset against Compensation or other sums due to the
                     Advisor under this Agreement &nbsp;or any other agreement, any debt, obligation or liability due or
                     owing or likely to become due or owing by the Advisor &nbsp;to the Company.</li>
                  <li>5.10 The Company shall be entitled at any time during this Agreement, and in any event on
                     termination, howsoever arising, to deduct from your Financial Advisor Compensation Schemeany monies
                     due from you to the Company including but not limited to any outstanding loans (including loans for
                     training costs), advances, the cost of repairing any damage or loss to the Company&rsquo;s property
                     caused by you, excess holiday and any other monies owed by you to the Company, to the extent
                     permitted by law.</li>
                  <li>5.11 The Advisoris responsible for ensuring that all taxes on or arising out of your earnings and
                     benefits provided to you levied by any country (including, without limitation, any interest,
                     penalties or fines in connection with such taxes) are duly paid. The Company will not bear any
                     liabilities for any such taxes. If the Company is required by applicable law to withhold or pay on
                     your behalf any such taxes the same will be deducted from amounts due to you from the Company. If
                     the Company is required to pay any such taxes when no amount is due to you from the Company, you
                     shall forthwith upon demand pay the relevant amount to the Company. The Company shall forward to
                     you evidence of payment of such taxes.</li>
                  <li>5.12 Any benefit or remuneration for the Advisor which is not expressly set out herein or referred
                     to in the Financial Advisor Compensation Scheme shall be at the sole discretion of the Company
                     without any binding legal effect on the Company to continue or improve any such benefit or
                     remuneration and the Company shall have absolute discretion to modify, change or discontinue
                     forthwith any such benefit or remuneration upon providing written notice to the Advisor.</li>
               </ol>
               <li>
                  <h2>6. POLICY DELIVERY</h2>
               </li>
               <p>The Advisor&nbsp;shall deliver the Policy, Policy endorsement and/or any supplementary aagreements to
                  the Policy owner within a time period prescribed by the Company. If the Advisor &nbsp;knows or has
                  reason to suspect that an insured person&nbsp;whose health or occupation has changed considerably
                  since the date of application for the Policy or Policy endorsement or any supplementary aagreements,
                  the Advisor&nbsp;will promptly provide to the relevant information,&nbsp;and return the
                  Policy,&nbsp;to the Company.</p>
               <li>
                  <h2>7. BOOKS AND RECORDS</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>7.1 In performing its obligations under this Agreement, the Advisorshall:</li>
                  <ol type="a">
                     <li>use prevailing forms, applications and documents issued by the Company;</li>
                     <li>use technology solutions which are currently utilisedby&nbsp;the Company; and</li>
                  </ol>
                  <p>ensure that the Policy owner has read, completed&nbsp;all information and understood the contents
                     of all claim forms/applications or documents before signing any of them.</p>
                  <li>7.2 The Advisorshall keep complete and accurate books of accounts and other records for the
                     purposes of recording all of the Advisor's transactions in connection with his/her appointment. The
                     Advisor&nbsp;shall closely adhere to all related guidelines issued by the Company in preparing such
                     books of accounts and records.</li>
                  <li>7.3 Any officer or authorized representative (including its auditors) of the Company shall have
                     the right at any time during normal business hours to examine such books and records relating to
                     the Advisor&rsquo;s transactions in connection with his/her appointment, and the Advisorshall
                     provide such person with the opportunity for inspection of such documents as may be required.</li>
               </ol>
               <li>
                  <h2>8.&nbsp;TERM AND TERMINATION</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>8.1 This Agreement shall commence from the date first above written and shall remain in force and
                     effect until terminated by either party in accordance with the terms thereof.</li>
                  <li>8.2 This Agreement may &nbsp;be terminated immediate by the Company if:</li>
                  <ol type="a">
                     <li>the Advisorpasses away or is permanently and totally disabled in such a manner as to be unable
                        to perform the obligations under this Agreement;</li>
                     <li>the Company terminates its operation or is declared bankrupt or insolvent in Myanmar;</li>
                     <li>the Advisoris prosecuted or convicted for any criminal offenses, including, but not limited to
                        acts of bribery, corruption, or money laundering;</li>
                     <li>the Advisorfails to comply with the &ldquo;Code of Conduct&rdquo; as prescribed by the Company
                        from time to time; &nbsp;</li>
                     <li>the Advisorcommits, organizes or participates in activities, which, in the Company&rsquo;s
                        discretion, make harm to or damage the Company&rsquo;s interests; or</li>
                     <li>the Advisorcommits a breach of the terms and conditions of this Agreement or the
                        Company&rsquo;s regulations;</li>
                     <li>the Advisordoes not meet training, production, professional ethics or other requirements
                        established by the Company, and as amended from time to time;</li>
                     <li>the Advisoris declared to fail to pay an outstanding amount within 7 calendar days since the
                        effective date of such declaration;</li>
                     <li>the Advisorviolates any of the terms and conditions, notices, guidelines or policies issued by
                        the Company from time to time;</li>
                     <li>the Advisorviolates or fails to comply with any of the terms and conditions, notices,
                        guidelines or policies set out by the government or Myanmar Insurance Association from time to
                        time;</li>
                     <li>the Advisorhas been discovered to have breached his duties and obligations under Clause 2 and
                        or any prohibitions under Clause 3;</li>
                     <li>the Advisorhas been discovered to having been involved in fraudulent activities, which could
                        place the Company, its business and interest or reputation at risks; or</li>
                     <li>the Advisorhas been discovered to be involved in any activities that are in competition with
                        the Company&rsquo;s business or interest.
                  </ol>
                  <li>8.3 The Advisorshall not be entitled to any compensation as a result of the termination of this
                     Agreement.</li>
                  <li>8.4 Upon termination of this Agreement:</li>
                  <ol type="a">
                     <li>all of the Advisor's rights to any and all compensation shall forthwith cease on termination of
                        this Agreement. However, when this Agreement is terminated only and solely due to Clause 8.2 (a)
                        or at the Company's election under Clause 8.1, the Company shall pay any accrued Compensation to
                        the Advisoror the inheritor/estate administrator of the Advisor&nbsp;pursuant to this Agreement
                        and applicable Financial Advisor Compensation Scheme&nbsp;up to the date of termination;</li>
                     <li>the Advisor shall forthwith return to the Company all due debts, including but not limited to
                        the advances or premiums. The Company has the right to impose a late performance penalty with
                        the term and interest at the Company's own and absolute discretion;</li>
                     <li>the Advisorshall forthwith cease to present, solicit or sell any Policy, whether directly or
                        indirectly binding the Company. The Advisor &nbsp;shall be solely liable for any activities
                        beyond the&nbsp;termination of this&nbsp;Agreement;</li>
                     <li>the Advisorshall return to the Company all Policies, receipts, rate books, manuals, all forms
                        and documents held by the Advisor &nbsp;bearing the name of the Company or at the Company's
                        expense. Advisor&nbsp;shall fully return to the Company the unused stationery, Advisor
                        &nbsp;card and all documents or properties related to the Company. The Advisor&nbsp;shall return
                        or supply copies of such parts of the Advisor's books or records relating to the Company, as the
                        Company may require; and</li>
                     <li>the Company may, if it deems fit, publish and/or circulate to any person or organization such
                        notice of the termination of the Advisor's appointment.
                  </ol>
                  <li>8.5 Within sixty (60) days from the date of obligation fulfillment as specified in Clause 8.4by
                     the Advisor, the Company shall settle any financial obligations and Financial Advisor Compensation
                     Scheme&nbsp;payable to the Advisor &nbsp;until the date of termination of this Agreement, if
                     applicable.</li>
                  <li>8.6 The Advisorshall indemnify, defend and hold Company, its officers, directors, agents,
                     employees, successors and customers harmless against any and all claim, liabilities, damages,
                     settlements, costs and expenses (including attorney&rsquo;s fees) made against or sustained by the
                     Company arising from: (i) the Advisor&rsquo;s performance of its obligations under this Agreement,
                     (ii) any infringement or violation of intellectual property rights of any person, or (iii) the
                     negligence or willful misconduct of Advisor; (iv) the Advisor 's breach of this Agreement;.</li>
               </ol>
               <li>
                  <h2>9.&nbsp;CONDUCT BEFORE AND AFTER TERMINATION</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>9.1 During the term of this Agreement, and the period of twenty four (24) months after the
                     termination of this Agreement &nbsp;however caused, the Advisor shall not, (i) whether directly or
                     indirectly, induce or attempt to induce any of the other Advisor of the Company (who are engaged by
                     the Company in the same capacity as the Advisor) to cease their business association or engagement
                     or service agreement with the Company or (ii)whether directly or indirectly, induce or attempt to
                     induce any customers or Policy owner of the Company, to proceed with any actions against the
                     Company with respect to any Policy, including:</li>
                  <ol type="a">
                     <li>any cancellation, lapse, forfeiture, or surrender such a Policy; or</li>
                     <li>any change to such a Policy in any manner so as to effect a reduction in cash surrender or
                        paid-up values.</li>
                  </ol>
                  <li>9.2 The Advisor&nbsp;shall account for and give an explanation of any complaint lodged against
                     him, and referred to the Company by any customers of the Company or any other party.</li>
                  <li>9.3 The Advisor&nbsp;undertakes that during the term of this Agreement and for a period of six (6)
                     months following the termination of this Agreement he/she shall not, whether on his own account or
                     otherwise and whether directly or indirectly:</li>
                  <ol type="i">
                     <li>solicit, interfere with, endeavour to entice away or induce to leave their employment or
                        engagement with the Company, any person who is, or was on the date of termination of his
                        employment or engagement with the Company (the &ldquo;Termination Date&rdquo;), a Relevant
                        Employee, agent or distribution partner; or</li>
                     <li>solicit, interfere with or endeavour to or actually entice away from the Company or any of its
                        Affiliates, business orders or custom for products or services similar to those being provided
                        by the Company from any person, firm or corporation who was at the Termination Date, or had been
                        at any time within the year ending on the Termination Date, a customer, an agent, a supplier or
                        a person in the habit of doing business with the Company or any of its affiliates and with whom
                        he was in contact with in the twelve (12) months immediately prior to the Termination Date.
                  </ol>
                  <li>9.4 The Advisoracknowledges and agrees that the duration, extent and application of each of the
                     above restrictions are no greater than is necessary for the reasonable protection of the proper
                     interests of the Company.</li>
                  <p>"Relevant Employee" means any person who (i) was employed by the Company or any of its Affiliates
                     for at least three (3) months prior to and on the Termination Date and (ii) with whom the
                     Advisor&nbsp;had material contact or dealings; or who was an executive staff member of the Company
                     or any of its Affiliates.</p>
                  <p>For the purpose of this Agreement, &ldquo;Affiliate&rdquo; means, in respect of a company or
                     corporation, any other person that is controlled by such company or corporation or that controls,
                     or is under common control with, such company or corporation and, for these purposes, a company or
                     corporation shall be treated as being controlled by a person if that person (a) directly or
                     indirectly holds more than twenty five percent (25%) of the equity interest or voting rights of
                     such company or corporation; (b) controls the composition of the majority of the board of directors
                     or equivalent body of such company or corporation; and / or (c) is able, by contract or otherwise,
                     generally to direct the management and operations of such company or corporation.</p>
               </ol>
               <li>
                  <h2> 10.&nbsp;ASSIGNMENT</h2>
               </li>
               <p>This Agreement shall be assignable by the Company, in whole or in part, to any successor, subsidiary,
                  affiliated or associated company of the Company. &nbsp;The Advisor&nbsp;shall not assign or purport to
                  assign any right or interest which the Advisor&nbsp;may have herein without the prior consent of the
                  Company. Any consent by the Company to any assignment by the Advisor shall not create or imply any
                  acknowledgement or responsibility on the part of the Company as to the validity or effect or
                  sufficiency of such assignment.</p>
               <li>
                  <h2>11.&nbsp;FORCE MAJEURE </h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>11.1 In case of any unforeseen events happen and hinder partially or entirely the responsibility
                     of the Parties in this Agreement, including, but not limited to, natural disasters, hurricanes,
                     storms, floods, earthquakes, fire, war, terrorism, riots, pandemics, performance failures of third
                     parties outside the control of the Parties, changes in regulatory systems or decisions by the
                     Government occur beyond the ability to predict and resolve of the Parties, andupon knowledge of
                     such an event,&nbsp;the Party affected by this unforeseen and uncontrollable event has to timely
                     notify the other Party of the actual occurrence of the&nbsp;said&nbsp;event&nbsp;and that its
                     failure to perform the Agreement &nbsp;due to such occurrence.&nbsp;Neither Party shall be liable
                     for any failure or delay in performance under this Agreement to the extent said failures or delays
                     are directly or proximately caused the unforeseen events beyond that non-performing Party's
                     reasonable control and occurring without its fault or negligence.</li>
                  <li>11.2 If&nbsp;the&nbsp;event of Force Majeure&nbsp;continues&nbsp;to cause failure or delay
                     in&nbsp;the performance under this Agreement by either Party for a period of more than six (6)
                     months, either Party may terminate this Agreement. &nbsp;</li>
               </ol>
               <li>
                  <h2>12.&nbsp;ANTI-BRIBERY AND ANTI-MONEY LAUNDERING</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>12.1 In performing this Agreement, the Advisormust</li>
                  <ol type="a">
                     <li>comply with all applicable anti-bribery and anti-corruption laws and regulations;</li>
                     <li>not offer any bribe or facilitation payment to any public official or other person;</li>
                     <li>comply with all applicable laws and regulations relating to anti-money laundering, counter
                        terrorist financing and financial and economic sanctions regimes (collectively, the
                        &ldquo;Anti-Money Laundering Requirements&rdquo;); and</li>
                     <li>not do anything that may cause&nbsp;the Company or any of its Affiliates to breach any
                        anti-bribery or anti-corruption law or any Anti-Money Laundering Requirement.
                  </ol>
                  <li>12.2 The Advisormust promptly notify the Company in writing of any actual or potential&nbsp;breach
                     of this Clause.&nbsp;&nbsp;</li>
                  <li>12.3 If it is in the Company's reasonable view that theAdvisorhas breached&nbsp;this Clause, the
                     Company may immediately terminate this Agreement without liability.</li>
                  <li>12.4 This Clause 12 shall survive the termination or expiry of this Agreement.</li>
               </ol>
               <li>
                  <h2>13. FRAUD REPORTING</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>13.1 If the Advisoris aware of or suspects any fraud related to the activities in his performance
                     of the scope of authorized activities, the Advisor&nbsp;shall report such suspected fraud to the
                     Supervisor or the Company.</li>
                  <li>13.2 This Clause 13 shall survive indefinitely the termination or expiration of this Agreement.
                  </li>
               </ol>
               <li>
                  <h2>14.&nbsp;CONFIDENTIALITY</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>14.1 The Advisor acknowledges and undertakes that</li>
                  <ol type="a">
                     <li>all Confidential Information will:</li>
                     <ol type="i">
                        <li>be utilized exclusively for this Agreement&rsquo;s objectives;</li>
                        <li>be kept strictly confidential; and</li>
                        <li>be returned to the Companyand/or destroyed by the Advisorat the discretion of the Company.
                        </li>
                     </ol>
                     <li>he/she will take all necessary steps to protect and prevent the unauthorized intrusion of
                        Confidential Information and/or the unauthorized disclosure of Confidential Information to any
                        third party. Necessary controlling and confidentiality measures include but are not limited to:
                     </li>
                     <ol type="i">
                        <li>safe storage and moving measures in case Confidential Information is in the form of written
                           documents; and</li>
                        <li>anti-virus measures as well as encoded softwares based on updated and current standards for
                           all desktops, laptops and other mobile applications in case Confidential Information is in
                           the form of electronic documents.
                     </ol>
                  </ol>
                  <li>14.2 The obligations of the Advisorto maintain the confidentiality of the Confidential Information
                     under Clause 14.1 shall not apply to any information that:</li>
                  <ol type="a">
                     <li>is or becomes part of information in the public domain, except if the disclosure of such
                        information in the public domain occurs as a result of any breach of this Agreement; or</li>
                     <li>was disclosed independently by a third party authorized to disclose this information; or</li>
                     <li>must be disclosed to any court or other government authority under applicable laws and
                        regulations.
                  </ol>
                  <li>14.3 In this Agreement, "Confidential Information" shall include any information relating to the
                     Company and its Affiliates &nbsp;(under any forms) including but not limited to any information
                     relating to the business, financial information, organization structure, customer information,
                     marketing information, business secrets concerning the operation of the Company and its Affiliates,
                     and any information that the Company or any of its Affiliates is required to keep confidential for
                     any third parties. This Clause shall survive indefinitely the termination or expiration of this
                     Agreement.</li>
               </ol>
               <li>
                  <h2>15.&nbsp;SEVERABILITY</h2>
               </li>
               <p>The provisions of this Agreement &nbsp;shall be severable in the event that any of the provisions
                  hereof are held by a court of competent jurisdiction to be invalid, void, or otherwise unenforceable,
                  and the remaining provisions shall remain enforceable to the fullest extent permitted by law.</p>
               <li>
                  <h2>16.&nbsp;GENERAL</h2>
               </li>
               <ol style="list-style-type:none;">
                  <li>16.1 This Agreement shall be governed and construed under the laws of Myanmar.</li>
                  <li>16.2 This Agreement constitutes the entire agreement between the Parties hereto with respect to
                     the subject matter hereof as at the date hereof and supersedes any prior agreement representations
                     or understandings, agreements, conditions, reservations either oral or in writing.</li>
                  <li>16.3 The term Advisor used in this Agreement means "Advisor " who signs this Agreement with the
                     Company and is subject to the respective Financial Advisor Compensation Schemeannounced by the
                     Company. Without prejudice to the generality of all other provisions of this Agreement, the Company
                     reserves the right, from time to time, to review and change these titles collectively or
                     individually, including the Financial Advisor Compensation Scheme.</li>
                  <li>16.4 Any failure or omission on the part of the Company to take any immediate action on any breach
                     of any of the terms and conditions of this Agreement &nbsp;on the part of the Advisor shall not be
                     construed as a waiver of the Company's rights to terminate this Agreement &nbsp;forthwith or pursue
                     any remedies available to it under the laws in force from time to time, or be construed as consent
                     or permission granted to the Advisor&nbsp;not to act in accordance with this Agreement . &nbsp;
                  </li>
                  <li>16.5 Except the right of the Company to amend, add, substitute or alter the Financial Advisor
                     Compensation Scheme, all amendments to the Agreement shall take no effect unless and only if they
                     are made in writing with valid signature of an authorized person of the Company thereon. The
                     Advisoracknowledges and agrees that the Company shall have the discretion to amend this Agreement
                     in accordance with laws, regulations, guidelines or policies set out by relevant authorities from
                     time to time in respect of the conduct of or performance of duties by insurance agents in Myanmar,
                     following which, a copy of the amendment agreement or addendum shall be delivered to the
                     Advisor&nbsp;as soon as reasonably practicable.</li>
                  <li>16.6 The Advisoracknowledges that in the event of a breach of this clause, the Company will suffer
                     irreparable harm and substantial damages. The Company hereby reserves its rights to report the
                     Advisor&nbsp;to the Myanmar Insurance Association in such an event, without prejudice to the
                     Company's rights of action for any damages it suffers as a result of such a breach.</li>
                  <li>16.7 The Parties irrevocably submit to the non-exclusive jurisdiction of the courts of Myanmar in
                     relation to any matter, claim or dispute arising out of or in connection with this Agreement.</li>
                  <li>16.8 During the&nbsp;term of this Agreement, the relationship of the Advisor with the Company will
                     be that of an independent contractor, and nothing in this Agreement is intended to, or should be
                     construed to, create a partnership, agency, joint venture or employment relationship between the
                     Advisor&nbsp;and the Company. Except as expressly provided in this Agreement, the Advisor&nbsp;will
                     not be entitled to, and will not receive, any benefits or compensation which the Company may make
                     available to its employees.</li>
                  <li>16.9 In the event of any conflict of interpretation between this Agreement and any translation,
                     the original English language shall prevail.</li>
               </ol>
               <p>&nbsp;</p>
               <p><em><em>This Agreement is made in two (2) originals with the same legal validity, each Party shall
                        retain one original. </em></em></p>
               <p style="text-align:center"><em><em>This page left blank intentionally</em></em></p>
               <p class="western" style="margin-bottom: 0.42in; line-height: 200%"><br><br></p>
               <p class="western" align="JUSTIFY" style="margin-top: 0.17in; margin-bottom: 0.08in"><br><br></p>
               <p class="western" align="JUSTIFY"
                  style="margin-top: 0.17in; margin-bottom: 0.08in; page-break-before: always">
                  <p><br /><strong><strong>IN WITNESS</strong></strong>&nbsp;whereof this Agreement has been executed by
                     the Parties on the date first above written.</p>
                  <table width="100%">
                     <tbody>
                        <tr>
                           <td width="361">
                              <p>For and on behalf of the Company</p>
                              <p><em><em>Signature</em></em></p>
                           </td>
                           <td width="390">
                              <p>The Advisor</p>
                              <p><em><em>Signature</em></em></p>
                              <img src="{{ public_path().'/storage/'.$applicant->sign_img }}" width="136" height="92">
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                           </td>
                           <td width="390">
                              <p>&nbsp;</p>
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>Name:</p>
                           </td>
                           <td width="390">
                              <p>Name:</p>
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>&nbsp;</p>
                           </td>
                           <td width="390">
                              <p>&nbsp;</p>
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>Witness</p>
                              <p><em><em>Signature</em></em></p>
                           </td>
                           <td width="390">
                              <p>Witness</p>
                              <p><em><em>Signature</em></em></p>
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                           </td>
                           <td width="390">
                              <p>&nbsp;</p>
                           </td>
                        </tr>
                        <tr>
                           <td width="361">
                              <p>Name:</p>
                              <p>{{ $applicant->name }}</p>
                           </td>
                           <td width="390">
                              <p>Name:</p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <p>&nbsp;</p>
                  <!-- Contract Ends -->
      </div>
</body>

</html>