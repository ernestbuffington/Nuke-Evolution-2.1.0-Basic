<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) { die('Bu dosyaya direkt olarak erişmeniz YASAKLANMIŞTIR'); }

$faq[] = array('--','Giriş ve Kayıt sorunları');
$faq[] = array('Neden giriş yapamıyorum?','Kayıt oldunuz mu? Giriş yapabilmek için önceden kayıt olmanız gerek. Yoksa mesaj panosundan yasaklandınız mı? (bu durumda bir mesaj görüntülenecektir) Eğer öyleyse, webmaster veya mesaj panosu yöneticisiyle irtibata geçip sebebini sorabilirsiniz. Eğer kayıt olduysanız ve yasaklanmış olmamanıza rağmen giriş yapamıyorsanız, tekrar tekrar kullanıcı adınızı ve şifrenizi kontrol edin. Genelde hata burada oluyor. Sorun bu değilse mesaj panosu yönetimi ile iletişime geçin, belki mesaj panosu için yanlış ayar yapmış olabilirler.');
$faq[] = array('Neden kayıt olmam gerekiyor?','Kayıt olmanıza gerek olmayabilirdi aslında. Mesaj gönderebilmek için kaydın şart olması, mesaj panosu yöneticisinin kararına bağlı. Ayrıca kayıt olunca bazı özel imkanlara ulaşabilirsiniz. Örneğin mesajlarınızın yanında kedinize ait küçük bir resim (avatar) gösterme, özel mesaj gönderme, tanıdığınız kullanıcılara mail gönderme veya kullanıcı gruplarına katılma imkanlarına misafir kullanıcılar sahip değildir. Kayıt işlemi çok basit olduğu için kayıt olmanız önerilir.');
$faq[] = array('Neden otomatik olarak çıkışım yapılıyor?','Giriş sayfasında gördüğünüz <i>Her ziyaretimde otomatik giriş yap</i> kutucuğunu işaretlemediğiniz sürece, mesaj panosu sizi sadece belirli bir süre için giriş yapmış kabul eder. Böylece kaydınızın başkaları tarafından kullanılması önlenir. Girişinizin devamlı kalması için, bu komutu seçmeniz yeterlidir. Fakat mesaj panosuna başka şahıslarında kullandığı (örn. herhangi bir kütüphaneye, internet kafeye, üniversiteye vs. ait) bir bilgisayardan giriş yapıyorsanız, bu komutu seçmeniz önerilmez.');
$faq[] = array('Çevrimiçi kullanıcı listesinde kullanıcı adımın görünmesini nasıl önleyebilirim?','Profil sayfanıza gidip <i>Çevrimiçi olduğumu gizle</i> seçeneğini bulabilirsiniz. Buradan <i>Evet</i> \'i seçince çevrimiçi olduğunuzu sadece mesaj panosu yöneticileri ve kendiniz görebilirsiniz. Bu durumda gizli kullanıcı olarak sayılırsınız.');
$faq[] = array('Şifremi unuttum!','Telaşa kapılmayın! Eski şifrenizi öğrenmek mümkün olmasa bile, yerine değişik bir şifre alabilirsiniz. Giriş sayfasını açıp <u>Şifremi unuttum</u> bağlantısına tıklayın ve tarif edilen işlemleri uygulayın. Kısa sürede tekrar çevrimiçi olduğunuzu göreceksiniz');
$faq[] = array('Kayıt oldum ama giriş yapamıyorum!','İlk önce kullanıcı adınızı ve şifrenizi doğru yazdığınızı temin edin. Doğru yazılmışsa, iki sebep daha olabilir. Eğer COPPA destekleniyorsa ve kaydınız esnasında <u>13 yaşından küçüğüm</u> bağlantısına tıkladıysanız, tarif edilen işlemleri uygulamanız gerek. Sebep bu değilse, kaydınızın onaylanması gerekebilir. Bazı mesaj panoları tüm yeni kayıtların onaylanmasını şart koşar. Giriş yapabilmeniz için ya kendiniz ya da mesaj panosu yöneticisi tarafından kaydınız onaylanmalıdır. Bu durumda onay gerekçesi, kaydınız esnasında size bildirilmiş olmalı. Bu doğrultuda bir e-posta aldıysanız, tarif edilen işlemleri uygulamanız gerek. Eğer böyle bir e-posta almadıysanız, verdiğiniz e-posta adresinin doğru olup olmadığını kontrol edin. Onay gerekçesinin sebebi, <i>kötü amaçlı</i> kullanıcıların anonim kalıp mesaj panosunu suistimal etmelerini önlemektir. Verdiğiniz e-posta adresinin doğru olduğundan eminseniz, mesaj panosu yöneticisiyle irtibata geçmeniz gerekir.');
$faq[] = array('Daha önce kayıt olmuştum ama artık giriş yapamıyorum?!','Bunun en olası sebebi hatalı kullanıcı adı veya şifre girişidir (kayıt olduktan sonra aldığınız e-postaya bakıp kontrol edin). Belkide mesaj panosu yöneticisi kaydınızı herhangi bir sebepten dolayı silmiş olabilir. Forumlara hiç mesaj gönderdiniz mi? Veritabanının kapladığı alanı küçük tutmak için, mesaj göndermeyen kullanıcıların kaydı genelde belirli bir süre sonra silinir. Tekrar kaydolmayı deneyin ve tartışmalara katılın.');
$faq[] = array('--','Kullanıcı Seçenekleri ve Ayarları');
$faq[] = array('Kullanıcı ayarlarımı nasıl değiştirebilirim?','Eğer kaydolduysanız bütün ayarlarınız veritabanına kaydedilir. Ayarlarınızı değiştirmek için (genelde sayfaların üst kısmında bulunan) <u>Profil</u> bağlantısını tıklayın. Ayarlarınız buradan değiştirilir');
$faq[] = array('Gösterilen zamanlar yanlış!','Gösterilen zamanlar büyük bir ihtimalle doğrudur. Fakat gördüğünüz zaman, bulunduğunuz yerin zaman diliminden farklı olabilir. Bu durumda, <u>Profil</u> bağlantısını tıklayıp kendiniz için geçerli zaman dilimini seçmeniz gerekir, örn. London, Paris, New York, Sydney vs. Çoğu seçenekler için geçerli olduğu gibi, zaman dilimini değiştirme imkanıda sadece kayıtlı kullanıcılara verilmiştir. Eğer kayıtlı değilseniz, kaydolmanın tam zamanı (kelime oyununu bağışlayın)!');
$faq[] = array('Değişik bir zaman dilimi seçtim ama saatler hala yanlış!','Doğru zaman dilimini seçtiğinizden eminseniz ve saat hala yanlış gösteriliyorsa, bunun en olası sebebi günışığından yararlanma değişimleri olabilir. Örn. yaz aylarında görülen saatler, bulunduğunuz ülkenin gerçek saatinden bir saat ileri veya geri olabilir. Mesaj panosu bu değişimleri dikkate almaz.');
$faq[] = array('Konuştuğum dil listede yok!','Bunun en olası sebepleri, ya mesaj panosu yöneticisinin konuştuğunuz lisanı destekleyen uzantıyı kurmuş olmayışı, ya da bu mesaj panosunun konuştuğunuz lisana henüz çevrilmiş olmayışıdır. Mesaj panosu yöneticilerine başvurup, kendi lisanınızı destekleyen uzantıyı kurmalarını rica edin. Eğer böyle bir uzantı yoksa, mesaj panosunu kendi dilinize çevirmekte özgürsünüz. Bu konuda daha geniş bilgi için sayfaların alt kısmında görülen phpBB Group bağlantısını tıklayın.');
$faq[] = array('Kullanıcı adımın altında resim göstermek için ne yapmalıyım?','Mesajların görüntülendiği sayfalarda kullanıcı adlarının altında iki tür resim görebilirsiniz. Birincisi, kullanıcı rütbenizi gösterir ve genelde gönderdiğiniz mesaj sayısına bağlı olarak belirli bir sayıda yıldız veya kare şeklindedir. Bunun altında avatar denen biraz daha büyük bir resim görebilirsiniz. Bu resim genelde kullanıcıya ait ve özeldir. Avatar kullanma imkanını mesaj panosu yöneticisi saptar. Ayrıca avatar\'ların ne şekilde kullanılabileceğinide saptar. Avatar kullanamıyorsanız, mesaj panosu yöneticisine başvurup bu imkanı ne sebepten iptal ettiğini öğrenebilirsiniz (bunun önemli bir sebebi olduğundan eminiz!)');
$faq[] = array('Kullanıcı rütbemi nasıl değiştirebilirim?','Genelde kullanıcı rütbenizi doğrudan değiştirmeniz mümkün değildir (kullanıcı rütbesi, gönderdiğiniz mesajın yanında bulunan isminizin altında ve kullanıcı profili sayfasında görülür). Çoğu mesaj panosunda kullanıcı rütbeleri, gönderilen mesajların sayısını veya yetkili üyeleri belirlemek için kullanılır, örn. yöneticiler veya mesaj panosu yöneticileri özel bir rütbeye sahip olabilir. Lütfen gereksiz yere mesaj gönderipte rütbenizi yükseltmeye çalışmayın, elde edeceğiniz tek sonuç, yöneticilerin mesajlarınızın sayısını düşürmesi olacaktır.');
$faq[] = array('Bir kullanıcıya ait e-posta bağlantısını tıklayınca giriş yapmam isteniyor?','Üzgünüz fakat e-posta formuyla maalesef sadece kayıtlı kullanıcılar e-posta gönderebiliyor (eğer yönetici bu özelliği aktif ettiyse). Bunun sebebi, e-posta sisteminin anonim kullanıcılar tarafından suistimal edilmesini önlemektir.');
$faq[] = array('--','Mesaj Gönderme Sorunları');
$faq[] = array('Bir foruma yeni bir başlık nasıl gönderilir?','Çok kolay, forumu veya başlığı görüntüleme sayfasında <i>Yeni Başlık Gönder</i> düğmesini tıklayın. Yeni mesaj göndermeden önce kayıt olmanız gerekebilir. Forum ve başlık sayfalarının alt kısmında yapabileceğiniz bütün işlemlerin listesini görebilirsiniz (örn. <i>Bu forumda yeni başlıklar gönderebilirsiniz</i> vs. gibi).');
$faq[] = array('Bir mesajı nasıl silebilir veya düzenleyebilirim?','Mesaj panosu yöneticisi veya moderatör olmadığınız sürece, sadece kendinize ait mesajları düzenleyebilir veya silebilirsiniz. Gönderdiğiniz bir mesajı <i>Mesajı Düzenle</i> düğmesini tıklayarak düzenleyebilirsiniz (bu imkan bazen sadece belirli bir süre için mevcuttur). Mesajınıza birileri cevap göndermişse eğer, mesajınızın altında metni kaç defa düzenlediğinizi gösteren kısa bir yazı göreceksiniz. Mesajınız henüz yanıtlanmamışsa, bu not görülmez. Ayrıca mesajınız mesaj panosu yöneticileri veya moderatörler tarafından düzenlenincede bu yazı görünmez (yöneticilerin böyle bir durumda metnin hangi kısmını ne sebepten dolayı düzenlediklerini yazmaları önerilir). Bir mesaja cevap geldikten sonra normal kullanıcılar tarafından silinemez.');
$faq[] = array('Mesajıma bir imza nasıl eklerim?','Herhangi bir mesaja imzanızı ekleyebilmek için önce <i>Profil</i> sayfanıza girip bir imza hazırlamanız gerek. Daha sonra mesaj gönderme formunun alt kısmındaki <i>İmzamı ekle</i> seçeneğini seçip mesajınıza imzanızı ekleyebilirsiniz. Gönderdiğiniz bütün mesajlara genel bir ayar olarak imzanızın eklenmesini istiyorsanız, <i>Profil</i> sayfasındaki seçeneği tıklayın. Buna rağmen dilediğiniz her mesaj için imzanızın eklenmesini önleyebilirsiniz (mesaj gönderme formunda <i>İmzamı Ekle</i> seçeneğinin işaretini kaldırmanız yeterlidir)');
$faq[] = array('Nasıl bir anket oluştururum?','Anket oluşturmak kolaydır, yeni bir başlık gönderirken (veya bir başlığın ilk mesajını düzenlerken (bu tabiki yetkinize bağlıdır)), mesaj gönderme formunun altında <i>Anket Ekle</i> formunu göreceksiniz (böyle bir formu göremiyorsanız, anket ekleme yetkiniz yok demektir). Anket sorusunu ve en az iki tane anket şıkkı eklemeniz gerekir. Anket şıkkı eklemek için <i>Bu Şıkkı Ekle</i> düğmesini tıklayın. Ayrıca anketin gösterim süresinide belirleyebilirsiniz, 0 süresiz demektir. Eklenebilecek anket şıklarının sayısı sınırlıdır. Bu sınırı mesaj panosu yöneticisi belirler');
$faq[] = array('Bir anketi nasıl değiştirir veya silerim?','Anketlerde mesajlar gibi sadece gönderen kullanıcı, moderatör veya mesaj panosu yöneticisi tarafından değiştirilebilir. Bir anketi değiştirmek için, başlığın ilk mesajını tıklayın (ilgili anket daima bu mesaja bağlıdır). Ankete henüz katılan olmadıysa, hazırlayan kullanıcı tarafından değiştirilebilir veya silinebilir. Ankete katılan olmuşsa, sadece forum ve mesaj panosu yöneticileri tarafından değiştirilebilir veya silinebilir. Böylece bir süre sonra şıkları değiştirip anket sonuçlarını saptırma olanağı kalmaz');
$faq[] = array('Neden bir foruma erişimim yok?','Bazı forumlar sadece belirli kullanıcılara veya kullanıcı gruplarına açık olabilir. Mesajları okumak, görüntülemek, göndermek için vs. özel yetki gerekebilir. Bu yetkiyi sadece ilgili moderatör veya mesaj panosu yöneticisi verebilir, bu kişilere başvurmalısınız.');
$faq[] = array('Neden anketlere oy veremiyorum?','Anketlere sadece kayıtlı kullanıcılar oy verebilir (böylece hile yapma olanağı önlenmiş olur). Eğer kayıt olmanıza rağmen hala anketlere oy veremiyorsanız, gerekli yetkilere sahip değilsiniz demektir.');
$faq[] = array('--','Biçimlendirme ve Başlık Tipleri');
$faq[] = array('BBCode nedir?','BBCode HTML\'in özel bir uygulamasıdır. Forum\'a yazdığınız mesajlarda BBCode kullanabilme imkanını mesaj panosu yöneticisi saptar. Ayrıca mesaj gönderme formundaki seçenekler sayesinde dilediğiniz mesajlarda BBCode\'ı iptal etmeniz mümkündür. BBCode, HTML\'e benzer tarzdadır fakat tag\'ler &lt; ve &gt; yerine köşeli parantez içine alınır: [ ve ]. Ayrıca nelerin nasıl görüntülendiği daha iyi kontrol edilebilir. BBCode hakkında daha geniş bilgiler için, mesaj gönderme sayfasından ulaşabileceğiniz rehbere bakınız.');
$faq[] = array('HTML kullanabilir miyim?','Mesaj panosu yöneticisinin izin vermesine bağlıdır, ilgili ayarların tümünü o kontrol eder. Eğer izin verilmişse, büyük ihtimalle sadece bazı tag\'lerin çalıştığını göreceksiniz. Böyle olması <i>güvenlik</i> içindir. Amaç, mesaj panosu görüntüsünün bozulmasını veya daha değişik sorunların meydana gelmesini önlemektir. İzin verilmiş olsa bile, mesaj gönderme formundaki seçenekler sayesinde dilediğiniz mesajlarda HTML\'i iptal etmeniz mümkündür.');
$faq[] = array('İfadeler nedir?','İfadeler veya Semboller, belirli duygu ifadelerini vermek için kullanılan işaretlerdir. Metinde küçük resimler halinde görüntülenir. Örn. :) mutlu, :( ise üzgün anlamındadır. Kullanabileceğiniz ifadelerin listesini mesaj gönderme formunda görebilirsiniz. İfadeleri aşırı derecede kullanmamaya özen gösterin, metin yoksa okunmaz hale gelebilir. Bu durumda yönetici ifadeleri veya mesajınızı tamamıyla silmeye karar verebilir');
$faq[] = array('Resim gönderebilir miyim?','Gönderdiğiniz mesajla beraber resimde görüntülenebilir. Fakat şu anda mesaj panosuna doğrudan resim göndermek mümkün değildir. Bu yüzden umuma açık bir web sunucusunda kayıtlı bir resme bağlantı vermeniz gerek, örn. http://www.umuma-acik-sunucu.net/resim.gif . Kendi bilgisayarınızda bulunan bir resme bağlantı vermeniz mümkün değil (bilgisayarınız umuma açık bir web sunucu olmadığı sürece). Ayrıca, umuma açık olmayan ve sadece şifreyle ulaşılan resimlere bağlantı vermek mümkün değildir (örn. hotmail veya yahoo mailboxlarında vs. kayıtlı resimler). Resim görüntülemek için, BBCode\'ın [img] tag\'ini yada (müsaade verilmişse) HTML kullanabilirsiniz.');
$faq[] = array('Duyurular nedir?','Duyurular çoğu zaman önemli bilgileri içerir, en kısa zamanda okumanızı öneririz. Duyurular, ilgili forumun her sayfasının başında görülür. Duyuru gönderebilmeniz için bu yetkiye sahip olmanız gerek. Yetkilerinizi ise mesaj panosu yöneticisi saptar.');
$faq[] = array('Sabit başlıklar nedir?','Sabit başlıklar, ilgili forumun ilk sayfasında, duyuruların hemen altında görülür. Çoğu zaman önemli bilgileri içerirler, mümkünse okumanızı öneririz. Duyurular için geçerli olduğu gibi, herhangi bir foruma sabit başlık göndermek için gereken yetkileri mesaj panosu yöneticisi saptar.');
$faq[] = array('Kilitli başlıklar nedir?','Bu başlıkları moderatör veya mesaj panosu yöneticisi kilitler. Kilitli başlıkları yanıtlamak mümkün değildir, içerdikleri anketler otomatik olarak sona erir. Başlıklar birçok nedenlerden dolayı kilitlenmiş olabilir.');
$faq[] = array('--','Kullanıcı Seviyeleri ve Grupları');
$faq[] = array('Yöneticiler nedir?','Yöneticiler, mesaj panosunun her bölümünde en çok yetkiye sahip olan şahıslardır. Bu kişiler, mesaj panosunun her türlü işlevini kontrol edebilir: izin verme, yetkilendirme, kullanıcı yasaklama, kullanıcı grupları oluşturma, moderatör yetkilerini verme vs. Ayrıca bütün forumlarda moderatör yetkilerine sahiptirler.');
$faq[] = array('Moderatörler nedir?','Moderatörler, günlük olarak forumun çalışmasını kontrol eden şahıslar veya gruplardır. Başlıkları değiştirme ve silme yetkisine sahip olabilirler. Ayrıca moderatör oldukları forumdaki başlıkları kilitleyebilir, taşıyabilir, silebilir ve bölebilirler. Genelde moderatörlerin görevi, <i>off-topic</i>, yani başlık konusuyla ilgisi olmayan yanıtların veya hakaret ve saldırı niteliğinde metinlerin gönderilmesini önlemektir.');
$faq[] = array('Kullanıcı grupları nedir?','Kullanıcı grupları, mesaj panosu yöneticilerinin kullanıcıları grup halinde ayırabilmesi için öngörülen bir yöntemdir. Her kullanıcı (çoğu mesaj panolarından farklı olarak) birçok gruba üye olabilir. Bu şekilde mesaj panosu yöneticileri belirli kullanıcılara rahatlıkla moderatör yetkilerini veya özel forumlara ulaşma yetkisini vs. verebilir');
$faq[] = array('Bir kullanıcı grubuna nasıl katılabilirim?','Bir kullanıcı grubuna katılabilmek için, herhangi bir sayfa üzerindeki kullanıcı grupları bağlantısına tıklayın. Kullanıcı gruplarının listesini göreceksiniz. Grupların tümü <i>erişime açık</i> olmayabilir, bazıları kilitli veya gizli olabilir. Grup açık ise, ilgili bağlantıya tıklayarak üye olmak için istekte bulunabilirsiniz. İsteğinizin kullanıcı grubu moderatörü tarafından onaylanması gerek, örneğin isteğinizin nedenini sorabilir. İsteğiniz reddedilirse grup moderatörünü lütfen rahatsız etmeyin, bunun nedenleri olsa gerek.');
$faq[] = array('Bir kullanıcı grubunun moderatörü olmak için ne yapmam gerek?','Kullanıcı grupları mesaj panosu yöneticisi tarafından açılır. Mesaj panosu yöneticisi aynı zamanda her grubun moderatörünü saptar. Eğer yeni bir kullanıcı grubu açmak istiyorsanız, ilk önce mesaj panosu yöneticisiyle irtibata geçmeniz gerek, kendisine özel mesaj göndermeyi deneyin.');
$faq[] = array('--','Özel Mesajlar');
$faq[] = array('Özel mesajlar gönderemiyorum!','Bunun üç sebebi olabilir; henüz kayıt olmamış veya giriş yapmamışsınız, veya mesaj panosu yöneticisi bütün mesaj panosu için özel mesajları iptal etmiş. Üçüncü olanak ise: mesaj panosu yöneticisi sizin bu imkanı kullanmanızı önlemiş olabilir, bu durumda kendisine nedenini sormanız gerekir.');
$faq[] = array('İstemediğim özel mesajları almaya devam ediyorum!','İleride özel mesajlar sistemine belirli kişilerden gelen mesajları iptal etme imkanını ekleyeceğiz. Şimdilik herhangi bir şahıstan istemediğiniz özel mesajlar alıyorsanız, mesaj panosu yöneticisine başvurun. O herhangi bir kullanıcıyı özel mesaj göndermekten men edebilir.');
$faq[] = array('Bu mesaj panosunda herhangi birinden spam e-posta aldım!','Üzgünüz. Aslında bu mesaj panosunun sunduğu email gönderme işlevi bundan korunmak için birçok önlemi almış bulunuyor. Aldığınız spam e-postanın bir kopyasını mesaj panosu yöneticisine gönderin. Özellikle aldığınız emailin başlık kısmını (to (kime), subject (konu) vs.) iletmeyi unutmayın, bu kısımda emaili gönderen kullanıcı hakkında bilgiler bulunur. Mesaj panosu yöneticisi bu bilgilerle meseleyi takip edebilir.');
//
// These entries should remain in all languages and for all modifications
//
$faq[] = array('--','phpBB 2 Konuları');
$faq[] = array('Bu mesaj panosunu kim yazdı?','Bu yazılım (değiştirilmemiş haliyle) <a href="http://www.phpbb.com/" target="_blank">phpBB Group</a> tarafından üretilmiş ve genel dağıtıma çıkarılmıştır. Tüm eser hakları phpBB Group\'a aittir. Bu eser, GNU General Public Licence antlaşmasına uygun olarak erişime açılmıştır. Bu antlaşmaya uyma şartıyla ücretsiz dağıtılabilir. Daha detaylı bilgiler için bağlantıya göz atın.');
$faq[] = array('Aradığım X özellik neden yok?','Bu yazılım phpBB Group tarafından yazılmış ve dağıtıma çıkarılmıştır. Eğer herhangi bir özelliğin eksik olduğunu düşünüyorsanız, lütfen phpbb.com sitesini ziyaret edip phpBB Group\'un ilgili düşüncelerini öğrenin. Lütfen phpbb.com sitesindeki forumlara yazıp yeni bir özellik isteğinde bulunmayın. phpbb Group sourceforge aracılığıyla yeni özellikler ekler. Lütfen ilgili forumları gezip ilk önce phpBB Group\'un herhangi bir özellikle ilgili tutumunu öğrenin ve daha sonra burada tarif edilen yöntemle başvuruda bulunun.');
$faq[] = array('Bu mesaj panosuyla ilgili hukuki sorunlar için veya suistimal durumlarda kime başvurabilirim?','Mesaj panosu yöneticisine başvurmanız önerilir. Mesaj panosu yöneticisinin kim olduğunu öğrenemezseniz, ilk önce moderatörlerden biriyle irtibata geçip, kime yazmanız gerektiğini öğrenin. Herhangi bir yanıt alamadığınız takdirde, site sahibine başvurun (whois aramasıyla sitenin sahibini öğrenebilirsiniz) veya (eğer site ücretsiz hizmet veren sitelerde çalıştırılıyorsa, örn. yahoo, free.fr, f2s.com vs.) sitenin yönetimine veya suistimal konularıyla ilgilenen şubesine başvurun. phpBB Group\'un bu mesaj panosunun nasıl, nerede ve kimler tarafından çalıştırıldığını kontrol etmediğini ve herhangi bir şekilde bundan sorumlu olmadığını lütfen dikkate alın. phpbb.com sitesiyle veya phpBB yazılımıyla doğrudan ilgisi olmayan herhangi bir hukuki konuda (ihtiyati tedbir, mali sorumluluk, iftira vs.) phpBB Group\'la irtibata geçmek tamamen anlamsızdır. Bu yazılımın herhangi üçüncü şahıslar tarafından kullanımıyla ilgili phpBB Group\'a e-posta yazarsanız, ya çok kısa bir cevap alırsınız ya da hiç cevap alamazsınız.');
//
// This ends the FAQ entries
//

?>