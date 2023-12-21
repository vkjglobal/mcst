<?php 
error_reporting(0);
include_once('includes/header.php');
include_once('includes/class.General.php');
//echo "HHI";exit;
 $objGen    =   new General();
if(isset($_GET['id'])){
    $id =   base64_decode($_GET['id']);

  $aboutUsList     =   $objGen->getcmsContentById($id); 
  $recentCurrentProj    =  end($objGen->getRecentcCurProj());
 // print_r($recentCurrentProj); exit;
}
?>
    <section class="our-team-section mb-5 pb-xl-5 pb-lg-4 pb-md-3">
        <div class="container">
            <?php echo $aboutUsList['content']; ?>
        </div>
    </section>
        <?php include_once('includes/footer.php'); ?>


    <!-- Team Member Details Popup Start -->
    <div class="modal fade" id="teamMemberDetails1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails1Label">Brad Carte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Brad Carte is MCST’s Operations Manager, based at CMI in Majuro He first joined MCST as Director of USP Marshall Islands campus in June 2020 before coming fulltime to CMI in 2022.</p>
                    <p>He obtained a BSc in Chemistry, with "Highest Distinction" from the University of Arizona and a PhD in Oceanography from the University of California San Diego, Department of Scripps Institution of Oceanography. He had a successful 25-year career in the Pharmaceutical and Biotech industries with a research focus on the discovery and development of new medicines from marine natural products.</p>
                    <p>In 2011 Brad moved to Fiji to join the Institute of Applied Sciences, USP as an Honorary Research Fellow. He has since served as a Lecturer in the School of Marine Studies where he coordinated courses in Coral Reef Ecology & Management and Marine Pollution, served as the Coordinator of the Fiji Locally Managed Marine Area (FLMMA) Network and was the Project Manager for the Global Environment Facility (GEF) funded Nagoya Protocol Access Benefit Sharing project "discovering nature-based products and building capacities for the application of the Nagoya Protocol on Access to Genetic Resources and Benefit Sharing in Fiji". He was most recently the Head of the College of Science, Technology & Environment at the Pacific Technical and Further Education (Pacific TAFE), USP.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails2Label">Fredrick Francis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Fredrick is our hard working finance offer at CMI’s Majuro Campus</p>
                    <p></p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails3Label">Aileen M. Sefeti</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Aileen is of Rotuman/Fijian decent, raised and brought up in Majuro, Marshall Islands. She served as a Research Assistant and the acting Project Coordinator for the Center for Vocational & Continuing Education (CVCE) at the University of the South Pacific (USP) Marshall Islands campus from 2017- early 2019. She went on to serve as the Administrative Assistant and Budget Officer at the Embassy of the Republic of the Marshall Islands (RMI) in Suva, Fiji from 2019 to 2023. Whilst serving at the Embassy, she was pulled in to work with the technical team for the Micronesian Center for Sustainable Transport (MCST) in 2021 to help provide support to Ambassador Ishoda (RMI’s Ambassador to Fiji then) who led RMI’s shipping decarbonization efforts at the regional and international fora. She is currently part of the MCST support team, and served as the Outreach Coordinator & Project Director back-up for the Ministerial Taskforce and the Special Envoy on Maritime Decarbonization for the RMI from 2022-2023. 
                    </p>
                    <p>
                        Aileen also attended the IMO meetings in London as part of the support team to the Marshall Islands delegation, particularly for the 14th Intersessional Working Group on Greenhouse Gas Emissions (ISWG-GHG) meeting and the 79th session of the Marine Protection Environment Committee (MEPC). She continues to participate and engage in IMO negotiations at ISWG-GHG/MEPC, and at national and regional meetings concerning transport and shipping decarbonization for the RMI.
                    </p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails4Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails4Label">Dr. Peter Nuttall</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Dr. Peter Nuttall is the Scientific and Technical Advisor for the Micronesian Center for Sustainable Transport. He wrote his PhD thesis on the potential for wind energy for shipping in the Pacific and established low carbon shipping as a priority multi-disciplinary research theme for USP since 2012. He has published and presented regionally and globally across this field since. Between 2008-2012 he supervised the first village-based surveys of maritime transport and fuel dependency at village level in Fiji. Since then he has been involved in action research in low carbon transport from the village to the global, including the current IMO work on decarbonisation of international shipping. Dr.Nuttall is also an acknowledged expert on the heritage of drua/kalia canoe technology in Central Oceania. With his sons he has built and operates the replica drua i Vola Siga Vou.  He has sailed extensively in the Pacific for 30 years and lives with his family on a sailing ship in Fiji which generates all its electricity renewably.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails5Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails5Label">Atina Schutz</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Atina Schutz is a legal researcher at the Micronesian Center for Sustainable Transport. She is passionate about finding and implementing solutions to address climate change and environmental impacts though law and policy.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails6Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails6Label">Maria Sahib</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ms. Maria Sahib is a dedicated professional with a passion for sustainable maritime practices and climate action. With a career spanning over a decade, she has contributed significantly to the fields of shipping decarbonisation, fisheries policy, and environmental sustainability. Her journey has taken her from the vibrant shores of the Marshall Islands to her beloved home country of Fiji.</p>
                    <p>She has dedicated the last five years of her career to the vital mission of decarbonising the shipping industry. Through research, advocacy, and active participation in International Maritime Organization (IMO) negotiations on climate change, she has been a catalyst for positive change in this critical sector.</p>
                    <p>Before her work in shipping, she had the privilege of serving the Marshall Islands government, where she played a pivotal role in fisheries policy and management. This experience provided her with invaluable insights into sustainable resource management and governance.</p>
                    <p>Currently, she proudly serves as the Coordinator for the Pacific bloc (6PAC+) in the IMO negotiations on climate change. Our collaborative efforts are instrumental in shaping global policies to combat climate change within the maritime industry.</p>
                    <p>She has spent nearly seven enriching years living and working in the Marshall Islands, where she developed a deep appreciation for Pacific cultures and the urgency of addressing environmental challenges. This period was a formative chapter in her career.</p>
                    <p>She holds a Master's degree in Development Studies, and her thesis focused on the assessment of eco-labelling in the Pacific region, with a particular emphasis on Marine Stewardship Council Certification. This research reflects her commitment to promoting sustainable practices and ensuring the responsible management of our oceans.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails7Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails7Label">John T</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Artistically, been in the Performing Arts for the past 10-15 years with Rako Pasefika as a senior performing artist, music tutor, researcher and choreographer. Performed on multiple international platforms with an experience in cultural ambassadorship and diplomacy.</p>
                    <p>Academically, graduated with a BA in History and Politics and currently a Postgraduate student in Diplomacy and International Affairs at the University of Hawaii. Participated in various regional negotiations and university youth leadership forums as well as a Peer mentor for undergraduate students for 4 semesters.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails8" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails8Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails8Label">Pierre Jean Bordahandy (PJ)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pierre-Jean Bordahandy (PJ) is currently Associate researcher at the Micronesian center for Sustainable Transport (MCST). PJ joins MCST's legal research team after 8 years of hard labor at USP's Law School as Associate Professor in Law teaching in the areas of the law of the sea, maritime law, international trade law and international fisheries. He holds a LLB from France, a diploma in criminal sciences, a D.E.S.S. (French L.L.M.) in Maritime and Transport Law (University of Aix-en-Provence), a L.L.M. in Private International Trade Law and comparative law (University of Stockholm), a doctorate in Private Law (University of Aix-en-Provence) and (cotutelle) a PhD in Maritime Law on “The concept of container and its legal implications” (University of Queensland – Australia).</p>
                    <p>PJ has worked in France for a couple of years as an in-house lawyer for a company involved in the international trade of flat glass (cargo claim, insurance policies, charter parties etc.). He has also worked in Australia for Gadens Lawyers and, occasionally, for Blake Dawson and Waldron advising on French law regarding mining related matters in New Caledonia.</p>
                    <p>PJ areas of research is shipping law generally and container carriage and container demurrage issues in particular. More recently, PJ has been privileged to be part of the technical support to the Pacific Delegations attending the IMO/MEPC negotiations on the reduction of greenhouse gas from ships. In that respect, PJ does research in international environmental law and on shipping decarbonization. He has recently published a joint research paper on decarbonization of shipping – Tax or not tax - as well as on the utilization of impact assessment tools and in particular regulatory impact assessments in relation to environmental law issues. PJ is also doing research in relation to deep sea mining, container demurrage and sea based marine plastic.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails9" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails9Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails9Label">Andrew Irvin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Following five years with the Climate Change Mitigation & Risk Reduction programme at the International Union for Conservation of Nature Oceania Regional Office, Andrew Irvin has joined the Micronesian Center for Sustainable Transport as Project Officer for the Cerulean Project, which represents a joint effort by USP and Swire Shipping Co. to devise a suitable route for a new class of low-carbon shipping vessel to sustainably provide shipping services to underserved outer island communities between Fiji and RMI. Andrew brings to MCST a range of experience managing renewable energy, energy efficiency, sustainable transport, and resource management projects in coordination with regional and international development partners. He has completed post-graduate and Masters studies in Climate Change with USP’s Pacific Centre for Environment & Sustainable Development (PaCE-SD). He is based in Suva, Fiji, where he has lived with his family for the past seven years.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails10" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails10Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails10Label">Wayne Kijiner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Wayne has been a passionate supporter of MCST for many years and our resident ‘go-to’ expert on alternative energy matters</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails11" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails11Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails11Label">Tristan Smith</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tristan leads a research group of 5 Research Associates and 8 PhD students focused on studying the global shipping industry. Together we combine expertise across engineering, economics, programming and optimisation, operations research, policy, business and finance.</p>
                    <p>My personal background is degrees in engineering and a specialisation and training in naval architecture. I worked as a practising naval architect on a number of defence research, design and upkeep projects (ships and submarines), before returning to university to undertake a PhD in naval architecture. Three years ago, I changed role to apply my knowledge of the marine environment and shipping, and skills in modelling, problem solving and team working to study the subject of the CO2 emissions of the shipping industry.</p>
                    <p>I attend IMO MEPC and associated meetings as a delegate of RINA and IMarEST. On the subject of shipping efficiency and emissions, I am a contributing author to work published at the IMO, at UNEP, in the UK Committee on Climate Change and a number of academic books and papers, and have carried out consultancy work for a number of organisations including Shell and the IEA.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails12" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails12Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails12Label">Dr Aly Shaw</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails13" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails13Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails13Label">Captain Professor Michael Vahs</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Michael Vahs, since 2000 appointed professor for ship operation and simulation at "Hochschule Emden-Leer" (University of Applied Sciences) has graduated in Maritime Transport from "Hamburg Polytechnical Institute" in 1989 and then undergone a career in the merchant marine on various types of ships up to the Captain's position. After 3 years of studying “Maritime Education and Training” he was appointed as Maritime Lecturer and qualified for Professor’s appointment in 2000. At university his field of research has been strongly related to green shipping, in particular the development and operation of sail systems for cargo ships. Since 2021 Michael  is co-chair of the new Fraunhofer research unit “Sustainable Maritime Mobility” at Fraunhofer IWES Bremerhaven and Hochschule Emden/Leer, Germany</p>
                    <p>Motto: It is easy to motivate oneself and navigate the right course when seeing a good purpose and being part of a community that is sharing a common vision.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails14" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails14Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails14Label">Christiaan De Beukelaer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Author of “Trade Winds: A Voyage to a Sustainable Future for Shipping” & Senior Lecturer in Culture & Climate at the University of Melbourne</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails15" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails15Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails15Label">Gavin Allwright</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Gavin has been Secretary general of the International Windship Association (IWSA) since it was established in 2014. This not-for-profit grouping of maritime wind propulsion companies and projects supported by academia & NGO’s is working to promote and facilitate the uptake of wind propulsion solutions in commercial shipping. He sits on the International Maritime Organisation (IMO) Maritime Technology Cooperation Centres (MTCC) stakeholder’s advisory committee and is a non-executive board member of the World Wind Energy Association (WWEA).</p>
                    <p>Gavin has presented and chaired numerous international fora including the Royal Institute of Naval Architect’s (RINA) Shipping Efficiency & Wind Propulsion conferences and led the team that organised the ground-breaking Ambition 1.5C: Global Shipping’s Action Plan summit at COP23 in Bonn, Germany</p>
                    <p>He is an advisor on a number of EU and international research projects, including: WASP, WiSP, VTAS and Decarbonising UK Freight. Gavin holds a Masters degree in Sustainable Development, specialising in small scale sustainable shipping and logistics in developing countries and has contributed to numerous studies on alternative propulsion solutions and most recently contributed as an expert reviewer to the IPCC Special Report on 1.5C Global Warming.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails16" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails16Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails16Label">Alison Newell MCIEEM C.Env</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Alison has been involved in sustainable sea transport for much of her professional career. She has lived on board a wooden sailing boat with her family for over 20 years, 15 spent in the Pacific Islands, and worked on commercial sailing vessels before that.  Alison was one of the original Sustainable Sea Transport Research Programme team and has been involved in research and education in the Pacific for over a decade.  Having worked as a commercial captain on wind-powered vessels in the Pacific, and now based on her boat in Aotearoa, she has many sea miles under her belt.</p>
                    <p>As a core team member of MCST in the past, Alison now provides support to the team when required. She's published and presented widely on shipping decarbonisation and has been heavily involved in the IMO facing GHG emissions reduction work.  Alison has also undertaken research and analysis of Pacific domestic shipping, including maritime data collection, GHG emissions mitigation analyses, NDC investment roadmaps for maritime transport, and priority project pipelines and concepts.  She has also secured financial support for MCST and Pacific Island governments for both domestic and international facing projects and programmes, including the Low Carbon Sea Transport project and IMO GHG emissions reduction work.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="teamMemberDetails17" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="teamMemberDetails17Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamMemberDetails17Label">Dr Hyeon-Ju Kim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Dr. Kim is the Principal Researcher, Offshore Plant, and Marine Energy Research Division, Korea Research Institute of Ships and Ocean Engineering (KRISO) and Project Manager of the Korean OTEC program. He received his Ph.D. at the Dept. of Ocean Engineering, Pukyong National University. His fields of specialization are Ocean Thermal Energy Conversion system technology, Seawater Desalination, and Mineral Extraction system technology, Deep Ocean Water Application technology for Food, Energy and Water. He is Vice Chairman of the Korean Society for Power System Engineering and a Member of the board of directors of the Korean Society for Marine Environment and Energy, The Korean Society of Ocean Engineering, etc.</p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Team Member Details Popup End -->
   
    <script>
        $(document).ready(function () {
            $('.home-banner').owlCarousel({
                loop: false,
                autoplay: false,
                mouseDrag: false,
                nav: false,
                dots: false,
                items: 1,
                smartSpeed: 450
            });
        })
    </script>
</body>

</html>