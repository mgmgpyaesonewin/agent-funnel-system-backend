<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta charset="utf-8">
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
    </style>
</head>

<body lang="en" link="#0000ff" dir="LTR">
    <p style="margin-bottom: 0.93in; display:flex; flex-direction: row-reverse">
        <img src="{{ asset('images/watermark.png') }}" width="136" height="92"><br>
    </p>
    <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.92in; widows: 0; orphans: 0">
        <font face="Calibri, serif">
            <font color="#000000">
                <font face="Verdana, serif">
                    <font size="4" style="font-size: 16pt"><b>MANAGEMENT ASSOCIATEFINANCIAL ADVISOR AGREEMENT</b></font>
                </font>
            </font>
        </font>
    </p>
    <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.5in; widows: 0; orphans: 0">
        <font face="Calibri, serif">
            <font color="#000000">
                <font face="Verdana, serif"><b>PRUDENTIAL MYANMAR LIFE INSURANCE LIMITED </b></font>
            </font>
        </font>
    </p>
    <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 0.5in; widows: 0; orphans: 0">
        <font face="Calibri, serif">
            <font color="#000000">
                <font face="Verdana, serif"><b>and</b></font>
            </font>
        </font>
    </p>
    <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 3.42in; widows: 0; orphans: 0">
        <font face="Calibri, serif">
            <font color="#000000">
                <font face="Verdana, serif"><b>[Name of Management AssociateFinancial Advisor]</b></font>
            </font>
        </font>
    </p>
    <p class="western" align="CENTER" style="margin-top: 0.17in; margin-bottom: 3.42in; widows: 0; orphans: 0">
        <font face="Calibri, serif">
            <font color="#000000">
                <font face="Verdana, serif">
                    <font size="4" style="font-size: 16pt">Agreement No: {{ $applicant->agreement_no ?? '' }}
                    </font>
                </font>
            </font>
        </font>
    </p>
    <p class="western">
        <font face="Calibri, serif">
            <span style="text-transform: uppercase">
                <font face="Verdana, serif">
                    <font size="2" style="font-size: 11pt">Table of Contents</font>
                </font>
            </span>
        </font>
    </p>
    <div>
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
        <font face="Calibri, serif">
            <font face="Verdana, serif">This Management AssociateAdvisor Financial Advisor Agreement (“Agreement”)
            </font>
            <font face="Verdana, serif">is made on the {{ $applicant->signed_date ?? '' }} by and between,
            </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">Prudential Myanmar Life Insurance Limited,
                a private limited company incorporated under the laws of the Republic of the Union of Myanmar,
                having its address at # 15-01,
                15</font><sup>
                <font face="Verdana, serif">th</font>
            </sup>
            <font face="Verdana, serif">Floor,
                Sule Square,
                221 Sule Pagoda Road,
                Kyauktada Township,
                the Republic of the Union of Myanmar </font>
            <font face="Verdana, serif">(hereinafter referred to as the “Company”) </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">and </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        {{ $applicant->name ?? 'Pyae Sone Win' }}
        <font face="Calibri, serif">
            <font face="Verdana, serif">,
                holding National Identity Card No. {{ $applicant->nrc ?? '...........' }},
                residing at {{ $applicant->address ?? '.................' }}</font>
            <font face="Verdana, serif">(hereinafter referred to as the “AssociateFinancial Advisor”,
                “Advisor”) </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">(Company and AssociateAdvisor individually referred to as a “Party” and
                collectively referred to as the “Parties”)</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">The Parties have agreed to enter into this Agreement under following terms and
                conditions: </font>
        </font>
    </p>
    <ol>
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797625"></a>
                <font face="Verdana, serif">APPOINTMENT AND AUTHORIZATION </font>
            </h1>
        </li>
    </ol>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.1</b></font>
            <font face="Verdana, serif">Subject to the terms and conditions of this Agreement and upon the date of its
                signing,
                the Company agrees to authorize the AssociateAdvisor,
                and the AdvisorAssociate agrees to accept such authorization,
                to carry out insurance consulting business to present,
                solicit,
                provide information,
                consult with and to help prospects to submit proper application forms for insurance products offered by
                the Company</font>
            <font face="Verdana, serif">to the designated offices of the Company</font>
            <font face="Verdana, serif">,
            </font>
            <font face="Verdana, serif">and</font>
            <font face="Verdana, serif">the AdvisorAssociate is authorized by the Company under the scope of operation
                of this Agreement to serve the needs and requirements of the policy owners of insurance policies issued
                by the Company ("Policy owner"and "Policy") during the term of this Agreement. </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.2</b></font>
            <font face="Verdana, serif">During the term of this Agreement,
                the </font>
            <font face="Verdana, serif">Advisor</font>
            <font face="Verdana, serif">Associate agrees and undertakes to only represent the Company under the scope of
                authorization stated under the terms of this Agreement. </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.3 </b></font>
            <font face="Verdana, serif">The</font>
            <font face="Verdana, serif"></font>
            <font face="Verdana, serif">AdvisorAssociate may operate anywhere within the territory of the Republic of
                the Union of Myanmar ("Myanmar") as the Company may decide from time to time,
                but no exclusive right in any district in Myanmar is assigned to the AssociateAdvisor. The Company also
                has the right to assign the AdvisorAssociate to any specific location within Myanmar. </font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.4 </b></font>
            <font face="Verdana, serif">The </font>
            <font face="Verdana, serif">AdvisorAssociate is not authorized and shall not have the power or authority to
                bind the Company or incur any liability or obligation,
                or act on behalf of the Company. While the Company is entitled to provide the Advisor Associate with
                general guidance to assist the AssociateAdvisor in completing the scope of work to the Company’s
                satisfaction,
                the AdvisorAssociate is ultimately responsible for directing and controlling the performance of the task
                and the scope of work,
                in accordance with the terms and conditions of this Agreement.</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.5</b></font>
            <font face="Verdana, serif"></font>
            <font face="Verdana, serif">Nothing contained herein shall require or be construed as requiring the Company
                to accept any application from any person presented by the </font>
            <font face="Verdana, serif">Advisor</font>
            <font face="Verdana, serif">Associate.</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1</b></font>
            <font face="Verdana, serif"><b>.6</b></font>
            <font face="Verdana, serif"></font>
            <font face="Verdana, serif"></font>
            <font face="Verdana, serif">In consideration for the AdvisorAssociate performing his/her obligations under
                this Agreement,
                the Company agrees to pay the compensation as Fees,
                Bonuses and IncentivesCommission and Bonus (“Consultancy Compensation”) under this Agreement as
                specified in the Financial Advisor Compensation Scheme issued and amended </font>
            <font face="Verdana, serif">by</font>
            <font face="Verdana, serif">the Company from time to time ("Financial Advisor Compensation
                Scheme").</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.7</b></font>
            <font face="Verdana, serif"> </font>
            <font face="Verdana, serif"> </font>
            <font face="Verdana, serif">For the purposes of the calculation of the Consultancy Compensation
                SchemeFinancial Advisor Compensation Scheme, the date of execution of this </font>
            <font face="Verdana, serif">Agreement</font>
            <font face="Verdana, serif"> by the AdvisorAssociate and the Company shall for the purpose of this provision
                only be treated as the date of appointment of the AdvisorAssociate, and the Consultancy Compensation
                SchemeFinancial Advisor Compensation Scheme shall not be payable by the Company unless and until the
                AssociateAdvisor has completed the requisite training courses provided by the Company and the relevant
                Regulatory Authorities including not limited to Financial Regulatory Department,
                Insurance Business Regulatory Board and Myanmar Insurance Association (“Regulators”) and have passed the
                required examinations set by the said Regulators.</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY"
        style="margin-left: 0.6in; text-indent: -0.6in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><b>1.8</b></font>
            <font face="Verdana, serif"> Unless otherwise specified, the AssociateAdvisor shall report to a designated
                Supervisor (“Supervisor”), who would be a member of staff appointed by the Company. The Company will
                have the sole discretion in appointing such Supervisor. In case the AssociateAdvisor assists a potential
                prospect to submit an insurance application to the Company, such application must be first signed by the
                appointed Supervisor, which would also be a pre-condition for acceptance of the application form by the
                Company.</font>
        </font>
    </p>
    <ol start="2">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797626"></a>
                <font face="Verdana, serif">OBLIGATIONS OF ASSOCIATEADVISOR </font>
            </h1>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The AssociateAdvisor shall comply with, at all times:</font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">all laws and regulations of </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">Myanmar</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-GB">and </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">judgments of the court</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">s of Myanmar and any relevant arbitral awards in Myanmar</span>
                    </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">; </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">any </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">code of conduct for the AssociateAdvisor issued by the Company; and</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in"><a
                    name="_Hlk41460708"></a>
                <font face="Verdana, serif">
                    <font size="2">professional guidelines,
                        policies appli</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-GB">cable to</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> the AssociateAdvisor or regulations set out by the Company</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">, </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">or relevant authorities including but not limited to the Financial
                            Regulatory Department, Insurance Business Regulatory Board and Myanmar Insurance Association
                        </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">that may in the future come into effect and </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">be </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">amended from time to time.</font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The AssociateAdvisor shall:</font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">carry out his</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/her</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> obligations under this Agreement and always conduct his</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/her</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> authorized assignments under the appointment of the Agreement with professionalism,
                        fairness, integrity and honesty; </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">employ his</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/her</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> skills and expertise to the best of his abilities, experiences, and knowledge;
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">report or provide </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">to the </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">Supervisor and the Company any information he</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/she</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">,
                        to the best of his</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/her</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> ability, knowledge, and prudence, considers necessary or relevant to</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US"> the</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> insurance business or business risks of the Company; </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">continue to provide after-sale</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">s</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> services to Policy</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US"> </span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">owners and their beneficiaries</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US"> as instructed by the Company from time to time</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">; </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US"> and</span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">p</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">rovide full and clear information about his</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">/her</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> roles and scope of authorization to avoid any confusion from </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">any</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"> prospective </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">P</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">olicy </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">owner</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">s,
                        customers, or any other third parties</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">.</span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The AssociateAdvisor shall ask any insured persons (prospective
                                or otherwise) to have a medical examination, if required, at clinics nominated by the
                                Company only, unless otherwise agreed or allowed in writing by the Company. In case the
                                AssociateAdvisor asks any insured person (prospective or otherwise) to have a medical
                                examination at any clinic, other than those nominated by the Company, the
                                AssociateAdvisor shall be responsible for such medical examination cost and the results
                                thereof shall not be recognized by the Company.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The AssociateAdvisor must clearly inform customers of his/her
                                own liabilities to the accuracy of information contained in any document provided to
                                customers, which are not issued by the Company; </font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="3">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797627"></a>
                <font face="Verdana, serif">PROHIBITIONS</font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font size="2">
                        <font color="#000000">
                            <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">The
                                        AssociateAdvisor shall not: </span></span></font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font color="#000000">
                        <font face="Verdana, serif"><span style="font-style: normal">sign any insurance document or
                                Agreement on behalf of </span></font>
                    </font>
                    <font color="#000000">
                        <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">any
                                </span></span></font>
                    </font>
                    <font color="#000000">
                        <font face="Verdana, serif"><span style="font-style: normal">party,
                                with his authority confined to only</span></font>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> verifying to those signatures that are
                            actually performed in their presence</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">represent to any persons or third
                            parties that he is authorized to accept notice of loss, negotiate terms of settlement,
                            settle or pay any loss or claim except where he is expressly authorized to do so by the
                            Company as stated in Clause 1.1</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span lang="en-GB"><span
                                style="font-style: normal">conspire</span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal"> or induce any Policy owner or any
                            other person to make any insurance claim of whatever nature</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font color="#000000">
                        <font face="Verdana, serif"><span style="font-style: normal">renew,
                                extend, alter or reinstate any Policy on behalf of the Company</span></font>
                    </font>
                    <font color="#000000">
                        <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                        </font>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">amend,
                            alter, add, delete, or substitute any such forms or documents or any documents belonging to
                            the Company or the </span></font>
                    <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal">P</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal">olicy owner or the </span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">insured
                                person</span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal"> from time to time</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> </span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">endeavor or attempt to induce, whether
                            directly or indirectly, any other </span></font>
                    <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal">a</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal">ssociate</span></font>
                    <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal">Advisor
                            </span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal"> or representative of the Company to
                            cease their business association with the Company or terminate </span></font>
                    <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal">their engagement or
                                services a</span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal">greementagreement with the
                            Company</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">make any statement</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"> or</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> representation in written or verbal
                            form which is to the AssociateAdvisor </span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">’</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal">s knowledge untrue, false or
                            unsubstantiated that prejudice or affect the Company's brand name and credit</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">mis-sell or
                                make</span></span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"> </span></span>
                    </font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">any statement or
                                representation in written or verbal form which is false in order to induce any Policy
                                owner (prospective or otherwise) to purchase any insurance product of the Company,
                            </span></span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">publish or cause to be published any
                            advertisement concerning the Company,
                            other insurance company, or insurance related company without the prior written authority of
                            the Company; nor shall the AssociateAdvisor issue, distribute or cause to be issued any
                            circular or to write or to cause to be written any letters to any newspaper, magazine or
                            publication in respect of the Company, other insurance company, or insurance related
                            company, without first obtaining the written approval of the Company</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> </span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">incur any liability on behalf of the
                            Company, pledge or purport to pledge the Company's credit or make any other Agreement
                            binding upon the
                            Company</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">revise any document</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">s issued by
                                the</span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal"> Company’s; </span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">print or circulate any advertisement or
                            printed items related to the Company or its operations without </span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">the </span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal">Company’s written approval</span>
                    </font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">; </span></span>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">on behalf of the Company, </span>
                    </font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">give</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> any information </span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">to the</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> </span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">mass media through
                                the or on</span></span></font>
                    <font face="Verdana, serif"><span style="font-style: normal"> radio</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"> or</span></span>
                    </font>
                    <font face="Verdana, serif"><span style="font-style: normal"> television or to a crowd</span></font>
                    <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"> of persons’;
                            </span></span></font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font face="Verdana, serif"><span style="font-style: normal">use software illustrating insurance
                            value, that is not provided by the Company. </span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">participate in any case and dispute related to any Company’s business
                        without the Company’s written approval’</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">act for any other companies, businesses, or agencies, whether directly
                        or indirectly, during the term of this Agreement, regardless of whether or not they operate a
                        competing business with the Company. (For the purpose of this provision, the AssociateAdvisor
                        hereby confirms and warrants that he/she is not currently working for or engaged in any capacity
                        by any other insurance companies); </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">negotiate,
                        enter into or cancel any agreement or accept any insurance risk on behalf of the Company, issue
                        any Policy, or bind the Company in any other manner; </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">represent or </font>
                    <font face="Verdana, serif">confirm to the Policy owner or any other person that he has been given
                        authorization to accept, or that the Company has accepted the application and/or issued the
                        Policy, unless prior notice in writing has been given by the Company; </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">give any assertion, assurance or promise relating to the endorsements of
                        the Policy or supplementary agreement</font>
                    <font face="Verdana, serif">s </font>
                    <font face="Verdana, serif">issued by the Company unless authorized in writing by the Company from
                        time to time; or</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">engage any other associateAdvisor or third party to undertake the
                        assignments or duties authorized by the Company under the terms and conditions of this Agreement
                        during the term of this Agreement without prior written approval from the Company.</font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="11">
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font size="2">
                    <font color="#000000">
                        <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal">The breach of
                                    any provisions in this clause shall result in the suspension or termination of this
                                    Agreement at the discretion of the Company. Any damage or loss as a result of such a
                                    violation shall be at the sole liability of the AssociateAdvisor. </span></span>
                        </font>
                    </font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="4">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797628"></a>
                <font face="Verdana, serif">COLLECTION AND REMITTANCE OF FUNDS</font>
            </h1>
        </li>
    </ol>
    <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif">
            <font size="2">T</font>
        </font>
        <font face="Verdana, serif">
            <font size="2">he AssociateAdvisor is not authorized to collect the premium or any fund from the Policy
                owner. The AssociateAdvisor shall not pay any premium or other payments required to be made on behalf of
                the Policy owner</font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-GB"> or any other person</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2"> to the Company. </font>
        </font>
    </p>
    <ol start="5">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797629"></a>
                <font face="Verdana, serif">COMPENSATION</font>
            </h1>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The < !-- Need to revise as Commission -->
                                AssociateAdvisor's
                                entitlement
                                to
                                the
                        </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">Consultancy</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            Compensation</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">Commission</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            items as mentioned in </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">the
                            </span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">Compensation
                            SchemeFinancial Advisor Compensation Scheme is conditional upon:</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="i">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the issuance
                        by the Company of the Policy (including endorsements and
                        supplementary Agreement s where applicable) and the Policy remaining
                        in force beyond any free lookback or cooling off period under
                        applicable laws and regulations or otherwise;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">receipt by
                        the Company of the relevant premiums from the Policy owner or any
                        third party authorized by the Policy owner;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">compliance
                        by the AssociateAdvisor with all provisions of this Agreement; and</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor’s name and personal identification code appearing
                        on the Application.</font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The Company shall, at its
                            sole discretion, have the right to alter, amend, substitute or
                            delete any part or parts of Compensation SchemeFinancial Advisor
                            Compensation Scheme whether in full or part from time to time, as
                            notified by the Company to the Policy owner and any such any change
                            shall be deemed to take effect from the date of such notice. In any
                            case, any amendments, substitution or deletion to the </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">Financial
                                Advisor Compensation Scheme</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">Commission
                            Scheme shall not affect the Consultancy Compensation payable to the
                            AssociateAdvisor prior to the effective date of such amendments,
                            substitutions or deletion of the Compensation SchemeFinancial
                            Advisor Compensation Scheme.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor shall
                            only be entitled to any Consultancy Compensation on the sale of any
                            insurance product if his/her name appears on the application form
                            for such insurance product. </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Whenever any Policy is
                            changed or converted to another Policy plan, any compensation
                            payable upon the changed or converted Policy shall be determined by
                            the rules of the Company in force at the time of such change or
                            conversion.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">When any Policy is
                            converted to another Policy plan which has a lower value, the
                            AssociateAdvisor is not entitled to receive any compensation, fees
                            or benefits from such Policies. </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">If the Company shall
                            refund the premiums to the Policy owner and cancel the Policy, the
                            AssociateAdvisor shall return to the Company the amount of
                            Consultancy Compensation received on the premiums refunded to the
                            Policy owner. The Company shall have sole right to deduct this
                            amount prior to any payment to the AssociateAdvisor.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">If the Company detects any
                            fraud committed by the AssociateAdvisor, including but not limited
                            to willfully misleading any the Policy owner (prospective or
                            otherwise) in order to for the purpose of making any claim for
                            compensation, or leading to the suspension or termination of any
                            Policy, the AssociateAdvisor shall repay to the Company any
                            compensation received in connection with such Policy. The Company
                            shall have sole right to deduct these amounts prior to any payment
                            to the AssociateAdvisor and take any actions in accordance with the
                            Clause 8.3. </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Upon the termination of
                            this Agreement, the AssociateAdvisor will cease to be entitled to
                            any compensation as per the then applicable and effective
                            Compensation SchemeFinancial Advisor Compensation Scheme,
                            irrespective of the Policies solicited by the AssociateAdvisor
                            which are in force at the time of the termination.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The Company has the right
                            to withhold or offset against Consultancy Compensation or other
                            sums due to the AssociateAdvisor under this Agreement or any
                            other agreement, any debt, obligation or liability due or owing or
                            likely to become due or owing by the AssociateAdvisor to the
                            Company.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The Company shall be
                            entitled at any time during </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">this
                                Agreement</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">,
                            and in any event on termination, howsoever arising, to deduct from
                            your </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">Compensation
                                schemeFinancial Advisor Compensation Scheme</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            any monies due from you to the Company including but not limited to
                            any outstanding loans (including loans for training costs),
                            advances, the cost of repairing any damage or loss to the Company’s
                            property caused by you, excess holiday and any other monies owed by
                            you to the Company, to the extent permitted by law</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">.</span></font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor is
                            responsible for ensuring that all taxes on or arising out of your
                            earnings and benefits provided to you levied by any country
                            (including, without limitation, any interest, penalties or fines in
                            connection with such taxes) are duly paid. The Company will not
                            bear any liabilities for any such taxes. If the Company is required
                            by applicable law to withhold or pay on your behalf any such taxes
                            the same will be deducted from amounts due to you from the Company.
                            If the Company is required to pay any such taxes when no amount is
                            due to you from the Company, you shall forthwith upon demand pay
                            the relevant amount to the Company. The Company shall forward to
                            you evidence of payment of such taxes.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Any benefit or
                            remuneration for the AssociateAdvisor which is not expressly set
                            out herein or referred to in the </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">Financial
                                Advisor </span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">Compensation
                            Scheme shall be at the sole discretion of the Company without any
                            binding legal effect on the Company to continue or improve any such
                            benefit or remuneration and the Company shall have absolute
                            discretion to modify, change or discontinue forthwith any such
                            benefit or remuneration upon providing written notice to the
                            AssociateAdvisor.</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="6">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797630"></a>
                <font face="Verdana, serif">POLICY
                    DELIVERY</font>
            </h1>
        </li>
    </ol>
    <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif">
            <font size="2">The AssociateAdvisor shall
                deliver the Policy, Policy endorsement and/or </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">any
                </span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">supplementary
            </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-GB">a</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">agreements
                to the Policy owner within a time period prescribed by the Company.
                If the AssociateAdvisor knows or has reason to suspect that an
            </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">insured
                    person</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">
                whose health or occupation has changed considerably since the date of
                application for the Policy or Policy endorsement or </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">any
                </span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">supplementary
            </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-GB">a</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">agreements,
                the AssociateAdvisor </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">will
                    promptly provide to the relevant information,</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">
                and return the Policy</font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">,</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">
                to the Company. </font>
        </font>
    </p>
    <ol start="7">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797631"></a>
                <font face="Verdana, serif">BOOKS
                    AND RECORDS</font>
            </h1>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">In performing its
                            obligations under this Agreement, the AssociateAdvisor shall:</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">use prevailing forms,
                        applications and documents issued by the Company;</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">use technology solutions
                        which are currently </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">utilised</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">
                    </font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">by</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">
                        the Company; and</font>
                </font>
            </p>
        </li>
    </ol>
    <p lang="en-US" align="JUSTIFY" style="margin-left: 0.55in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif">
            <font size="2">ensure that </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">the
                </span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">Policy
                owner has read</font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">,
                    completed</span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">
                all information and understood </font>
        </font>
        <font face="Verdana, serif">
            <font size="2"><span lang="en-US">the
                </span></font>
        </font>
        <font face="Verdana, serif">
            <font size="2">contents
                of all claim forms/applications or documents before signing any of
                them.</font>
        </font>
    </p>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor shall
                            keep complete and accurate books of accounts and other records for
                            the purposes of recording all of the AssociateAdvisor's
                            transactions in connection with his/her appointment. The
                            AssociateAdvisor shall closely adhere to all related guidelines
                            issued by the Company in preparing such books of accounts and
                            records. </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Any officer or authorized
                            representative (including its auditors) of the Company shall have
                            the right at any time during normal business hours to examine such
                            books and records relating to the AssociateAdvisor’s transactions
                            in connection with his/her appointment, and the AssociateAdvisor
                            shall provide such person with the opportunity for inspection of
                            such documents as may be required.</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="8">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797632"></a>
                <font face="Verdana, serif">TERM
                    AND TERMINATION</font>
            </h1>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">This Agreement has a two
                            (2) year term and can be extended for a further two (2) years at
                            the election of the Company. Either Party may terminate this
                            Agreement at any time without being required to give any reason or
                            pay any compensation, by giving the other party not less than
                            thirty (30) working days’ prior written notice</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">shall
                                commence from the date first above written and shall remain in
                                force and effect until terminated by either party in accordance
                                with the terms thereof</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">This Agreement may be
                            terminated immediate by the Company if:</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor passes away or is permanently and totally disabled
                        in such a manner as to be unable to perform the obligations under
                        this Agreement;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the Company
                        terminates its operation or is declared bankrupt or insolvent in
                        Myanmar;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor is prosecuted or convicted for any criminal
                        offenses, including, but not limited to acts of bribery, corruption,
                        or money laundering; </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor fails to comply with the “Code of Conduct” as
                        prescribed by the Company from time to time; </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor commits, organizes or participates in activities,
                        which, in the Company’s discretion, make harm to or damage the
                        Company’s interests; or</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor commits a breach of the terms and conditions of
                        this Agreement or the Company’s regulations;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor does not meet training, production, professional
                        ethics or other requirements established by the Company, and as
                        amended from time to time;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor is declared to fail to pay an outstanding amount
                        within 7 calendar days since the effective date of such declaration;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor violates any of the terms and conditions, notices,
                        guidelines or policies issued by the Company from time to time;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor violates or fails to comply with any of the terms
                        and conditions, notices, guidelines or policies set out by the
                        government or Myanmar Insurance Association from time to time; </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor has been discovered to have breached his duties and
                        obligations under Clause 2 and or any prohibitions under Clause 3;</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor has been discovered to having been involved in
                        fraudulent activities, which could place the Company, its business
                        and interest or reputation at risks; or </font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">the
                        AssociateAdvisor has been discovered to be involved in any
                        activities that are in competition with the Company’s business or
                        interest. </font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor shall
                            not be entitled to any compensation as a result of the termination
                            of this Agreement.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Upon termination of this
                            Agreement:</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">all of the
                        AssociateAdvisor's rights to any and all compensation shall
                        forthwith cease on termination of this Agreement. However, </font>
                    <font face="Verdana, serif">when
                        this Agreement is terminated only and solely due to Clause 8.2 (a)
                        or at the Company's election under Clause 8.1, the Company shall pay
                        any accrued Consultancy Compensation to the AssociateAdvisor or the
                        inheritor/estate administrator of the AssociateAdvisor pursuant to
                        this Agreement and applicable Compensation SchemeFinancial Advisor
                        Compensation Scheme up to the date of termination;</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">the AssociateAdvisor shall
                        forthwith return to the Company all due debts, including but not
                        limited to the advances or premiums. The Company has the right to
                        impose a late performance penalty with the term and interest at the
                        Company's own and absolute discretion;</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">t</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">he
                        AssociateAdvisor shall forthwith cease to present, solicit or sell
                        any Policy, whether directly or indirectly binding the Company. The
                        AssociateAdvisor shall be solely liable for any activities beyond
                        th</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">e</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">
                        termination of th</font>
                </font>
                <font face="Verdana, serif">
                    <font size="2"><span lang="en-US">is</span></font>
                </font>
                <font face="Verdana, serif">
                    <font size="2">
                        Agreement;</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">the AssociateAdvisor shall
                        return to the Company all Policies, receipts, rate books, manuals,
                        all forms and documents held by the AssociateAdvisor bearing the
                        name of the Company or at the Company's expense. AssociateAdvisor
                        shall fully return to the Company the unused stationery,
                        AssociateAdvisor card and all documents or properties related to
                        the Company. The AssociateAdvisor shall return or supply copies of
                        such parts of the AssociateAdvisor's books or records relating to
                        the Company, as the Company may require; and</font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US" class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Verdana, serif">
                    <font size="2">the Company may, if it
                        deems fit, publish and/or circulate to any person or organization
                        such notice of the termination of the AssociateAdvisor's
                        appointment.</font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">Within sixty (60) days
                            from the date of obligation fulfillment as specified in Clause 8.</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">4</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            by the AssociateAdvisor, the Company shall settle any financial
                            obligations and Consultancy Compensation</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">
                                Scheme</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">Financial
                            Advisor Compensation Scheme payable to the AssociateAdvisor until
                            the date of termination of this Agreement, if applicable.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor shall
                            indemnify, defend and hold Company, its officers, directors,
                            agents, employees, successors and customers harmless against any
                            and all claim, liabilities, damages, settlements, costs and
                            expenses (including attorney’s fees) made against or sustained by
                            the Company arising from: (i) the AssociateAdvisor’s performance
                            of its obligations under this Agreement, (ii) any infringement or
                            violation of intellectual property rights of any person, or (iii)
                            the negligence or willful misconduct of AssociateAdvisor; (iv) the
                            AssociateAdvisor 's breach of this Agreement;.</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="9">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797633"></a>
                <font face="Verdana, serif">CONDUCT
                    BEFORE AND AFTER TERMINATION</font>
            </h1>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">During the term of this
                            Agreement, and the period of twenty four (24) months after the
                            termination of this Agreement however caused, the AssociateAdvisor
                            shall not, (i) whether directly or indirectly, induce or attempt
                            to induce any of the other associateAdvisor s of the Company (who
                            are engaged by the Company in the same capacity as the
                            AssociateAdvisor) to cease their business association or engagement
                            or service agreement with the Company or (ii)whether directly or
                            indirectly, induce or attempt to induce any customers or Policy
                            owner of the Company, to proceed with any actions against the
                            Company with respect to any Policy, including:</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">any
                        cancellation, lapse, forfeiture, or surrender such a Policy; or</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">any change
                        to such a Policy in any manner so as to effect a reduction in cash
                        surrender or paid-up values.</font>
                </font>
            </p>
        </li>
    </ol>
    <p lang="en-US" align="JUSTIFY"
        style="margin-left: 0.56in; text-indent: -0.31in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif">
            <font size="2">9.2 The AssociateAdvisor
                shall account for and give an explanation of any complaint lodged
                against him, and referred to the Company by any customers of the
                Company or any other party.</font>
        </font>
    </p>
    <p lang="en-US" align="JUSTIFY"
        style="margin-left: 0.56in; text-indent: -0.31in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif">
            <font size="2">9.3 The AssociateAdvisor
                undertakes that during the term of this Agreement and for a period of
                six (6) months following the termination of this Agreement he/she
                shall not, whether on his own account or otherwise and whether
                directly or indirectly:</font>
        </font>
    </p>
    <ol type="i">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.04in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">solicit,
                        interfere with, endeavour to entice away or induce to leave their
                        employment or engagement with the Company, any person who is, or was
                        on the date of termination of his employment or engagement with the
                        Company (the “</font>
                    <font face="Verdana, serif">Termination
                        Date</font>
                    <font face="Verdana, serif">”), a Relevant Employee,
                        agent or distribution partner; or</font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.04in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif">solicit,
                        interfere with or endeavour to or actually entice away from the
                        Company or any of its Affiliates, business orders or custom for
                        products or services similar to those being provided by the Company
                        from any person, firm or corporation who was at the Termination
                        Date, or had been at any time within the year ending on the
                        Termination Date, a customer, an agent, a supplier or a person in
                        the habit of doing business with the Company or any of its
                        affiliates and with whom he was in contact with in the twelve (12)
                        months immediately prior to the Termination Date.</font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="2">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor
                            acknowledges and agrees that the duration, extent and application
                            of each of the above restrictions are no greater than is necessary
                            for the reasonable protection of the proper interests of the
                            Company.</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <p class="western" align="JUSTIFY" style="margin-top: 0.04in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">"Relevant
                Employee" means any person who (i) was employed by the Company
                or any of its Affiliates for at least three (3) months prior to and
                on the Termination Date and (ii) with whom the AssociateAdvisor had
                material contact or dealings; or who was an executive staff member of
                the Company or any of its Affiliates.</font>
        </font>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.04in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">For the
                purpose of this Agreement, “Affiliate” means, in respect of a
                company or corporation, any other person that is controlled by such
                company or corporation or that controls, or is under common control
                with, such company or corporation and, for these purposes, a company
                or corporation shall be treated as being controlled by a person if
                that person (a) directly or indirectly holds more than twenty five
                percent (25%) of the equity interest or voting rights of such company
                or corporation; (b) controls the composition of the majority of the
                board of directors or equivalent body of such company or corporation;
                and / or (c) is able, by contract or otherwise, generally to direct
                the management and operations of such company or corporation.</font>
        </font>
    </p>
    <ol start="10">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797634"></a>
                <font face="Verdana, serif">ASSIGNMENT</font>
            </h1>
        </li>
    </ol>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif">This
                Agreement shall be assignable by the Company, in whole or in part, to
                any successor, subsidiary, affiliated or associated company of the
                Company. The AssociateAdvisor shall not assign or purport to assign
                any right or interest which the AssociateAdvisor may have herein
                without the prior consent of the Company. Any consent by the Company
                to any assignment by the AssociateAdvisor shall not create or imply
                any acknowledgement or responsibility on the part of the Company as
                to the validity or effect or sufficiency of such assignment.</font>
        </font>
    </p>
    <ol start="11">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797635"></a>
                <font face="Verdana, serif">FORCE
                    MAJEURE</font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">In case of any unforeseen
                            events happen and hinder partially or entirely the responsibility
                            of the Parties in this Agreement, including, but not limited to,
                            natural disasters, hurricanes, storms, floods, earthquakes, fire,
                            war, terrorism, riots, </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">pandemics,
                            </span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">performance
                            failures of third parties outside the control of the Parties,
                            changes in regulatory systems or decisions by the Government occur
                            beyond the ability to predict and resolve of the Parties, and</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">
                                upon knowledge of such an event,</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            the Party affected by this unforeseen and uncontrollable event has
                            to timely notify the other Party of the actual occurrence of the</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">
                                said</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            event</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-US">
                                and that its failure to perform the Agreement due to such
                                occurrence.</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            Neither </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">P</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">arty
                            shall be liable for any failure or delay in performance under this
                            Agreement to the extent said failures or delays are directly or
                            proximately caused the unforeseen events beyond that non-performing
                        </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">P</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">arty's
                            reasonable control and occurring without its fault or negligence.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">If</font>
                            <font face="Verdana, serif">
                            </font>
                            <font face="Verdana, serif"><span lang="en-GB">the</span></font>
                            <font face="Verdana, serif">
                                event of Force Majeure</font>
                            <font face="Verdana, serif"> </font>
                            <font face="Verdana, serif"><span lang="en-GB">continues</span></font>
                            <font face="Verdana, serif">
                                <font size="3"><span lang="en-GB">
                                        to </span></font>
                            </font>
                            <font face="Verdana, serif"><span lang="en-GB">cause
                                    failure </span></font>
                            <font face="Verdana, serif">
                                <font size="3"><span lang="en-GB">or
                                    </span></font>
                            </font>
                            <font face="Verdana, serif"><span lang="en-GB">delay
                                </span></font>
                            <font face="Verdana, serif"><span lang="en-GB">in</span></font>
                            <font face="Verdana, serif"><span lang="en-GB">
                                    the performance under this Agreement </span></font>
                            <font face="Verdana, serif"><span lang="en-GB">by
                                    either Party for a period of more than six (6) months, either Party
                                    may terminate this Agreement. </span></font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <p lang="en-US" align="JUSTIFY" style="margin-left: 0.55in; margin-top: 0.08in; margin-bottom: 0.08in">
        <br><br>
    </p>
    <ol start="12">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797636"></a><a name="_Toc402797637"></a>
                <font face="Verdana, serif">ANTI-BRIBERY AND ANTI-MONEY LAUNDERING</font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">In performing this
                            Agreement, the AssociateAdvisor must </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p lang="en-US">
                <font face="Times New Roman, serif">
                    <font size="2">
                        <font face="Verdana, serif">comply
                            with all applicable anti-bribery and anti-corruption laws and
                            regulations; </font>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US">
                <font face="Times New Roman, serif">
                    <font size="2">
                        <font face="Verdana, serif">not
                            offer any bribe or facilitation payment to any public official or
                            other person;</font>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US">
                <font face="Times New Roman, serif">
                    <font size="2">
                        <font face="Verdana, serif">comply
                            with all applicable laws and regulations relating to anti-money
                            laundering, counter terrorist financing and financial and economic
                            sanctions regimes (collectively, the “Anti-Money Laundering
                            Requirements”); and </font>
                    </font>
                </font>
            </p>
        </li>
        <li>
            <p lang="en-US">
                <font face="Times New Roman, serif">
                    <font size="2">
                        <font face="Verdana, serif">not
                            do anything that may cause&nbsp;the Company or any of its Affiliates
                            to breach any anti-bribery or anti-corruption law or any Anti-Money
                            Laundering Requirement. </font>
                    </font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">The AssociateAdvisor must
                            promptly notify the Company in writing of any actual or potential</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            breach of this Clause.</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                        </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"> </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">If </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">it
                                is in the Company's reasonable view that the</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">AssociateAdvisor
                        </font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">has
                            </span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">breache</font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2"><span lang="en-GB">d</span></font>
                    </font>
                    <font face="Verdana, serif">
                        <font size="2">
                            this Clause, the Company may immediately terminate this Agreement
                            without liability.</font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Verdana, serif">
                        <font size="2">This Clause 12 shall
                            survive the termination or expiry of this Agreement.</font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="13">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797638"></a>
                <font face="Verdana, serif">FRAUD
                    REPORTING</font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">If
                                the AssociateAdvisor is aware of or suspects any fraud related to
                                the activities in his performance of the scope of authorized
                                activities, the AssociateAdvisor shall report such suspected fraud
                                to the Supervisor or the Company. </font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">This
                                Clause 13 shall survive indefinitely the termination or expiration
                                of this Agreement. </font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="14">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797639"></a>
                <font face="Verdana, serif"><span lang="de-DE">CONFIDENTIALITY</span></font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The
                                AssociateAdvisor acknowledges and undertakes that</font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p class="western" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">all
                            Confidential Information will:</span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol type="i">
        <li>
            <p class="western" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">be
                            utilized exclusively for this Agreement’s objectives;</span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">be
                            kept strictly confidential; and</span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">be
                            returned to the Companyand/or destroyed by the AssociateAdvisor at
                            the discretion of the Company.</span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol type="a" start="2">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">he/she
                            will take all necessary steps to protect and prevent the
                            unauthorized intrusion of Confidential Information and/or the
                            unauthorized disclosure of Confidential Information to any third
                            party. Necessary controlling and confidentiality measures include
                            but are not limited to: </span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol type="i">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">safe
                            storage and moving measures in case Confidential Information is in
                            the form of written documents; and</span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">anti-virus
                            measures as well as encoded softwares based on updated and current
                            standards for all desktops, laptops and other mobile applications in
                            case Confidential Information is in the form of electronic
                            documents.</span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The
                                obligations of the AssociateAdvisor to maintain the confidentiality
                                of the Confidential Information under Clause 14.1 shall not apply
                                to any information that: </font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol type="a">
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">is
                            or becomes part of information in the public domain, except if the
                            disclosure of such information in the public domain occurs as a
                            result of any breach of this Agreement; or</span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">was
                            disclosed independently by a third party authorized to disclose this
                            information; or </span></font>
                </font>
            </p>
        </li>
        <li>
            <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                <font face="Calibri, serif">
                    <font face="Verdana, serif"><span lang="de-DE">must
                            be disclosed to any court or other government authority under
                            applicable laws and regulations. </span></font>
                </font>
            </p>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">In
                                this Agreement, "Confidential Information" shall include
                                any information relating to the Company and its Affiliates (under
                                any forms) including but not limited to any information relating to
                                the business, financial information, organization structure,
                                customer information, marketing information, business secrets
                                concerning the operation of the Company and its Affiliates, and any
                                information that the Company or any of its Affiliates is required
                                to keep confidential for any third parties. This Clause shall
                                survive indefinitely the termination or expiration of this
                                Agreement. </font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <ol start="15">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797640"></a>
                <font face="Verdana, serif">SEVERABILITY</font>
            </h1>
        </li>
    </ol>
    <h6 lang="en-US" class="western" style="text-indent: 0in; margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Verdana, serif"><span style="font-style: normal"><span style="font-weight: normal">The
                    provisions of this </span></span></font>
        <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"><span
                        style="font-weight: normal">Agreement
                    </span></span></span></font>
        <font face="Verdana, serif"><span style="font-style: normal"><span style="font-weight: normal">
                    shall be severable in the event that any of the provisions hereof are
                    held by a court of competent jurisdiction to be invalid, void, or
                    otherwise unenforceable, and the remaining provisions shall remain
                    enforceable to the fullest extent permitted by law</span></span></font>
        <font face="Verdana, serif"><span lang="en-US"><span style="font-style: normal"><span
                        style="font-weight: normal">.</span></span></span></font>
    </h6>
    <ol start="16">
        <li>
            <h1 lang="en-US" class="western"><a name="_Toc402797641"></a>
                <font face="Verdana, serif">GENERAL
                </font>
            </h1>
        </li>
    </ol>
    <ol start="11">
        <ol>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">This
                                Agreement shall be governed and construed under the laws of
                                Myanmar.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">This
                                Agreement constitutes the entire agreement between the Parties
                                hereto with respect to the subject matter hereof as at the date
                                hereof and supersedes any prior agreement representations or
                                understandings, agreements, conditions, reservations either oral or
                                in writing.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The
                                term AssociateAdvisor used in this Agreement means
                                "AssociateAdvisor " who signs this Agreement with the
                                Company and is subject to the respective Compensation
                                SchemeFinancial Advisor Compensation Scheme announced by the
                                Company. Without prejudice to the generality of all other
                                provisions of this Agreement, the Company reserves the right, from
                                time to time, to review and change these titles collectively or
                                individually, including the Compensation SchemeFinancial Advisor
                                Compensation Scheme.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">Any
                                failure or omission on the part of the Company to take any
                                immediate action on any breach of any of the terms and conditions
                                of this Agreement on the part of the AssociateAdvisor shall not
                                be construed as a waiver of the Company's rights to terminate this
                                Agreement forthwith or pursue any remedies available to it under
                                the laws in force from time to time, or be construed as consent or
                                permission granted to the AssociateAdvisor not to act in accordance
                                with this Agreement . </font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">Except
                                the right of the Company to amend, add, substitute or alter the
                                Compensation SchemeFinancial Advisor Compensation Scheme, all
                                amendments to the Agreement shall take no effect unless and only if
                                they are made in writing with valid signature of an authorized
                                person of the Company thereon. The AssociateAdvisor acknowledges
                                and agrees that the Company shall have the discretion to amend this
                                Agreement in accordance with laws, regulations, guidelines or
                                policies set out by relevant authorities from time to time in
                                respect of the conduct of or performance of duties by insurance
                                agents in Myanmar, following which, a copy of the amendment
                                agreement or addendum shall be delivered to the AssociateAdvisor as
                                soon as reasonably practicable. </font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The
                                AssociateAdvisor acknowledges that in the event of a breach of this
                                clause, the Company will suffer irreparable harm and substantial
                                damages. The Company hereby reserves its rights to report the
                                AssociateAdvisor to the Myanmar Insurance Association in such an
                                event, without prejudice to the Company's rights of action for any
                                damages it suffers as a result of such a breach.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">The
                                Parties irrevocably submit to the non-exclusive jurisdiction of the
                                courts of Myanmar in relation to any matter, claim or dispute
                                arising out of or in connection with this Agreement.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">During
                                the&nbsp;term of this Agreement, the relationship of the
                                AssociateAdvisor with the Company will be that of an independent
                                contractor, and nothing in this Agreement is intended to, or should
                                be construed to, create a partnership, agency, joint venture or
                                employment relationship between the AssociateAdvisor and the
                                Company. Except as expressly provided in this Agreement, the
                                AssociateAdvisor will not be entitled to, and will not receive, any
                                benefits or compensation which the Company may make available to
                                its employees.</font>
                        </font>
                    </font>
                </p>
            </li>
            <li>
                <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
                    <font face="Times New Roman, serif">
                        <font size="2">
                            <font face="Verdana, serif">In
                                the event of any conflict of interpretation between this Agreement
                                and any translation, the original English language shall prevail. </font>
                        </font>
                    </font>
                </p>
            </li>
        </ol>
    </ol>
    <p lang="en-US" align="JUSTIFY" style="margin-left: 0.55in; margin-top: 0.08in; margin-bottom: 0.08in">
        <br><br>
    </p>
    <p class="western" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in">
        <font face="Calibri, serif">
            <font face="Verdana, serif"><i>This
                    Agreement is made in two (2) originals with the same legal validity,
                    each Party shall retain one original. </i></font>
        </font>
    </p>
    <p lang="en-US" align="JUSTIFY" style="margin-top: 0.08in; margin-bottom: 0.08in; page-break-before: always">
        <font size="2">
            <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal"><b>IN
                            WITNESS</b></span></span></font>
            <font face="Verdana, serif"><span lang="en-GB"><span style="font-style: normal">
                        whereof this Agreement has been executed by the Parties on the date
                        first above written.</span></span></font>
        </font>
    </p>
    <br /><br /><br /><br /><br /><br /><br /><br />
    <img src="{{ asset('images/watermark.png') }}" width="136" height="92">
    <br />
    <p>{{ $applicant->name ?? '..........' }}</p>
</body>

</html>