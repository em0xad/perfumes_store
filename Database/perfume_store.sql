-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 05, 2025 at 11:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfume_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `category` enum('men','women','unisex','best_seller') NOT NULL,
  `perfume_detail` varchar(1000) NOT NULL DEFAULT ' لايوجد وصف'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `images`, `category`, `perfume_detail`) VALUES
(1, 'Jaguar Men Classic EDT', 450.00, 'أناقة رجولية مهيمنة بنفحات حمضية وخشب دافئ.', 'images/products/Men/1-1.png', 'men', 'يفتتح العطر بنفحاتٍ منعشة من البرغموت المنعش وماندرين ناضج يُشعرك بالحيوية. ;تتوسطه نسمات اللافندر والزنجبيل التي تضفي عمقًا وتعقيدًا كهربائيًا. ;تنبثق في القلب لمساتٍ خشبية من خشب الصندل تمنح ثباتًا وديمومة. ;يتحرّك نحو قاعدةٍ دافئة من العنبر والفانيليا تضفي لمسة رجولية وحسية. ;المزيج العام يذكرك بنسيم صباح ربيعي يداعب البشرة بثقة وأناقة.'),
(2, 'Versace Men Dylan', 580.00, 'انتعاش بحري حاد بقوة الفلفل والمسك، ثقة مطلقة.', 'images/products/Men/2-1.png', 'men', 'ينطلق Dylan Blue بقهقهة حمضيات البرغموت والجريب فروت المنعشة التي توقظ الحواس. ;تتخللها أوراق التين لتعزيز البُعد المائي الأنيق. ;في القلب ينبثق الفلفل الأسود المخملي مع باتشولي يضفي حرارة راقية. ;تستقر في القاعدة طبقات المسك واللبان لثباتٍ مذهل طوال اليوم. ;عطر يرسخ ثقة الرجل العصري في كل خطوة.'),
(3, 'GIORGIO ARMANI Aqua Di Gio', 600.00, 'نسيم بحري شفاف بلمسات ليمون وياسمين، أناقة صيفية.', 'images/products/Men/3-1.png', 'men', 'تشرق Aqua Di Gio بنفحات المحيط البديعة والليمون الصافي كنسمة بحرية منعشة. ;تتناغم معها لمسة النعناع الرقيقة لتعزيز الإحساس بالنقاء. ;تتوسطه زهور الياسمين واللافندر في قلبٍ زهري أنيق. ;تنخفض الرائحة إلى قاعدةٍ خشبية من الأرز والباتشولي تمنح عمقًا ودفء. ;تحاكي شعور الحرية المطلقة تحت ضوء الشمس البحرية.'),
(4, 'Dunhill Men Icon Elite', 350.00, 'خشبي حار نبيل بنفحات الهيل والفيتيفر، فخامة بريطانية.', 'images/products/Men/4-1.png', 'men', 'يفتتح Icon Elite بلمسة الهيل الحار والبرتقال المرّ المنعش مع شذى البرغموت. ;في القلب ينبض الفيليبري الأسود والفيتيفر بنفحات ترابية أنيقة. ;تتخلل طبقات المريمية والعنبر لمسة عطاءٍ دافئ. ;تستقر القاعدة على خشب الصندل والجلد المدبوغ لمنح طابعٍ فخمٍ ومهيب. ;عطر يعكس روح الفخامة البريطانية الكلاسيكية.'),
(5, 'Paco Rabbane Men Invictus', 330.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/5-1.png', 'men', 'ينبض Invictus بانتعاش الجريب فروت البحري يليه خفق أوراق الغار العطري. ;تتوسطه لمسة الياسمين والأمبرغريس بنفحاتٍ شفافة وحيوية. ;تنخفض الروائح تدريجيًا إلى قاعدةٍ خشبية من غاياك وباتشولي تمنح ثباتًا قويًا. ;تعكس الرائحة روح الانتصار والنصر في كل رشة. ;مثالي للرجل الرياضي الباحث عن الطاقة والحيوية.'),
(6, 'Carolina Harrera Bad Boy', 399.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/6-1.png', 'men', 'يفتتح Bad Boy بثنائية الفلفل الأبيض والأسود مع لمسة برغموت أخضر منعش. ;تتوسطه نوتات الأرز والمريمية التي تضفي بعدًا عطريًا خشبيًا. ;تتلاحم في القاعدة فول تونكا والكاكاو لمنح عمقٍ وحلاوة متمردة. ;تزدان الرائحة بجرأة التباين بين البرودة والدفء. ;عطر مثالي للرجل الجريء الباحث عن التميز.'),
(7, 'Dolce & Gabbana Women The Only', 485.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/1-1.png', 'women', 'تفتتح The Only One بعبق القهوة الدافئ متبوعًا برقّة الكمثرى الناضجة. ;تتوسطها نفحات السوسن والإيريس لعمقٍ زهريٍّ مترف. ;تتناغم في الأساس قاعدة الكراميل والفانيليا لحلاوة فاخرة. ;يدوم أثر العطر لساعات طويلة دون أن يفقد أناقته. ;يعبّر عن أنوثة جذابة وساحرة بلا منافس.'),
(8, 'Michael Kors Women Sexy', 360.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/2-1.png', 'women', 'يفتح Sexy Amber بصخب العنبر الدافئ الذي يأسر الحواس فوراً. ;تتوسطه باقة الزهور البيضاء الرقيقة كالبتونيا والياسمين. ;تصاحبه خشب الصندل المخملي لثباتٍ مدهش وأسلوبٍ رقيق. ;ينساب العطر بدفء ونعومة مثالية للمساءات. ;يجمع بين الأنوثة والغموض في توليفة لا تُقاوم.'),
(9, 'Bvlgari Splendid Jasmin Noir', 520.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/3-1.png', 'women', 'يفتتح Splendida Jasmin Noir برقّة الجاردينيا ولمسة “Green Sap” غامضة. ;يتوسطه ياسمين السامباك المترف مع نفحة اللوز المخملية. ;يبدأ الانخفاض إلى قاعدةٍ خشبية من الصندل والفول تونكا. ;تختتم النفحات بباتشولي وكاشميران لدفءٍ وسحرٍ يدومان طويلاً. ;عطر يحاكي سحر الليل والغموض الفاخر.'),
(10, 'Versace Pour Femme Dylan Blue', 570.00, 'فاكهي زهري بارد بقوة الباتشولي والمسك، أنوثة عميقة.', 'images/products/women/4-1.png', 'women', 'ينبثق Dylan Blue Pour Femme بنفحات التفاح الأخضر والكشمش الأسود المثلج. ;تتوسطه باقة من الورود والياسمين مع لمسة خوخ مثلج. ;ينتقل إلى قاعدةٍ من المسك والأخشاب البيضاء لثباتٍ وأناقة. ;يمتزج الباتشولي الستيري مع الفستق لعمقٍ مغري. ;عطر يوازن بين الأنوثة والقوة بلمسة عصرية.'),
(11, 'Carolina Herrera Women Good Girl', 540.00, 'حاد، زهور ليلية وحلويات الفانيليا، تمرد أنثوي أنيق.', 'images/products/women/5-1.png', 'women', 'يفتتح Good Girl بعبق اللوز والقهوة مع نفحات البرغموت والليمون المنعشة. ;تتوسطه أزهار التوبيروز والياسمين السامباك بثراءٍ زهريٍّ جذاب. ;تتلاشى الروائح إلى قاعدةٍ من فول تونكا والكاكاو الدافئ. ;تُختتم بتوليفة من الفانيليا والمسك والخشب الدافئ. ;يعكس تمرد الأنوثة بجرأةٍ وأناقة.'),
(12, 'Jean Paul Gaultier Women Scandal', 365.00, 'عسلي زهري جريء بعطر البرتقال الدموي والعسل، مغامرة فاخرة.', 'images/products/women/6-1.png', 'women', 'ينبثق Scandal بنفحات البرتقال الدموي الجريء والماندرين الزاهي. ;يتوسطه العسل والجاردينيا والياسمين لثقلٍ زهريٍّ جورماند. ;يهبط إلى قاعدةٍ من الباتشولي وشمع النحل والكاراميل الغني. ;تتخلل لمسات العرقسوس لدفءٍ متمرد. ;عطر يجسد الفتنة والجرأة دون مساومة.'),
(13, 'Dolce & Gabbana Women The Only', 465.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/1-1.png', 'unisex', 'يُعيد The Only One (Unisex) دفء القهوة والكراميل مع نفحات الكمثرى الرقيقة. ;يتوسطه إيريس والياسمين لعمقٍ زهريٍّ أنيق. ;ينخفض إلى قاعدةٍ من الفانيليا والباتشولي لمسةٍ مغرية. ;يثبت على البشرة لساعات مع ثباتٍ معتدل. ;عطر يناسب الجميع بجرعةٍ متوازنة من الأنوثة والدفء.'),
(14, 'Michael Kors Women Sexy', 550.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/2-1.png', 'unisex', 'يشرق Sexy Amber (Unisex) بعنبرٍ دافئ يتلوه عبق الزهور البيضاء. ;تتوسطه لمسات خشب الصندل المخملي لثباتٍ لافت. ;ينسدل بدفءٍ غامض يدوم طويلاً. ;يخلق توازنًا مثاليًا بين الغموض والرقة. ;مثالي لكل الأوقات والمناسبات.'),
(15, 'Bvlgari Splendid Jasmin Noir', 650.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/3-1.png', 'unisex', 'يفتتح Splendida Jasmin Noir (Unisex) برقة الجاردينيا ولمسةٍ نباتيةٍ مخضرة. ;يتوسطه ياسمين السامباك المخملي مع نفحة اللوز. ;يهبط إلى قاعدةٍ خشبية من الصندل وفول تونكا الفاخر. ;تُختتم بنفحات الباتشولي والكاشميران الدافئة. ;عطر يجمع بين الغموض والرومانسية.'),
(16, 'Versace Pour Femme Dylan Blue', 640.00, 'فاكهي زهري بارد بقوة الباتشولي والمسك، أنوثة عميقة.', 'images/products/Unisex/4-1.png', 'unisex', 'يمزج Dylan Blue Pour Femme (Unisex) بين الكشمش الأسود والتفاح المثلج. ;تتوسطه الورود والياسمين مع لمسة خوخ باردة. ;يهبط إلى قاعدةٍ من الأخشاب البيضاء والباتشولي. ;يثبت على البشرة بثباتٍ متوسط يدوم ساعات. ;عطر يجمع بين الأنوثة والقوة بلا تمييز.'),
(17, 'Carolina Herrera Women Good Girl', 370.00, 'حاد، زهور ليلية وحلويات الفانيليا، تمرد أنثوي أنيق.', 'images/products/Unisex/5-1.png', 'unisex', 'يفتح Good Girl (Unisex) بمزيج اللوز والقهوة مع نفحات البرغموت. ;تتوسطه أزهار التوبيروز والياسمين لثراءٍ زهريٍّ جذاب. ;تتلاشى إلى فول تونكا والكاكاو بقاعدةٍ دافئة. ;تضاف لمسة الفانيليا والمسك لتعزيز الثبات. ;عطر يفرض حضوره بثقةٍ مشتركة.'),
(18, 'Jean Paul Gaultier Women Scandal', 490.00, 'عسلي زهري جريء بعطر البرتقال الدموي والعسل، مغامرة فاخرة.', 'images/products/Unisex/6-1.png', 'unisex', 'ينبثق Scandal (Unisex) بجرأة البرتقال الدموي والعسل الحلو. ;يتوسطه الجاردينيا والياسمين لثقلٍ زهريٍّ جورماندي. ;ينخفض إلى باتشولي وشمع النحل لدفءٍ غامض. ;تُضاف لمسة الكاراميل لتعزيز الإغراء. ;عطر يناسب كل الأجناس بجرأةٍ متساوية.'),
(23, 'Dolce & Gabbana Women', 599.00, ' عطر نسائي كلاسيكي يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الياسمين والورد', 'images/best-product/B1-1.png', 'best_seller', ' لايوجد وصف'),
(24, 'Jean Paul Gaultier', 590.00, 'عطر جريء يجمع بين الفانيليا الدافئة والمسك، مع لمسة من الزنجبيل والحمضيات', 'images/best-product/B2-1.png', 'best_seller', ' لايوجد وصف'),
(25, 'Carolina Harrera Women 212 VI', 380.00, 'عطر أنثوي فاخر يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.', 'images/best-product/B3-1.png', 'best_seller', ' لايوجد وصف');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'emad', 'emad.aladl@gmail.com', '$2y$10$inbAGuRCBh4kylZ9WnFyZOPv/yzBlYRbDBGuCk8oYr6gcUTDwB/.W', 'admin'),
(2, 'ali', 'ali@gmail.com', '$2y$10$fkwvdPJE53oke8lpFPzuA.gsWFuN7KbAUx32pk3xd/U6RLsZMXFCC', 'user'),
(3, 'omar65', 'omar@gmail.com', '$2y$10$IaR4JQUfgyv27dmvxc4Ir.ln3Z.Cd0dp0SkfuudODfbltivrfbLhq', 'user'),
(4, 'ahmad', 'ahmad@gmail.com', '$2y$10$x5nPt9dHaJB/9JJHCJX3IeozAdkcb2RQ/8oQ58xJJOm024JeP.z82', 'user'),
(5, 'admin', 'admin@example.com', '$2y$10$Vm5H5nACWv74q0VnuVMWMunIFknGJLPI8q8hBBx/IPxy/vH76CB6y', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
