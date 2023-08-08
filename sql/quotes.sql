-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08.08.2023 klo 13:55
-- Palvelimen versio: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotes`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `work` varchar(255) DEFAULT NULL,
  `series` varchar(255) DEFAULT NULL,
  `quote` varchar(1000) NOT NULL,
  `char1` varchar(255) DEFAULT NULL,
  `char2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `quotes`
--

INSERT INTO `quotes` (`id`, `author`, `work`, `series`, `quote`, `char1`, `char2`) VALUES
(1, 'Josh Lanyon', 'The Hell You Say', 'The Adrien English Mysteries', 'A pause followed my greeting. Then “We’re watching you” whispered the voice on the other end.\r\n“Yeah? Did you see what I did with my keys?”\r\nSilence. Then dial tone.\r\nThese younger demons. So easily discouraged.', 'Adrien English', NULL),
(2, 'Josh Lanyon', 'Death of a Pirate King', 'The Adrien English Mysteries', 'I thought again how odd it was to be on formal terms with someone you had once permitted to lick your ears.', 'Adrien English', NULL),
(3, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', '“I will not surrender my profession simply because men throughout history have been unduly enamored of their penises!”', 'Dr. Christine Putnam', NULL),
(4, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', 'I seldom ate out, both for reasons of economy and because I feared someone might try to speak to me.', 'Percival Whyborne', NULL),
(5, 'Josh Lanyon', 'A Dangerous Thing', 'The Adrien English Mysteries', '“Adrien, people get killed all the time. Since when is it your job to find out what happened to them?”\r\n“I’m not usually suspected of murdering them.”\r\n“You have been as long as I’ve known you.”', 'Jake Riordan', 'Adrien English'),
(6, 'Jordan L. Hawk', 'Treshold', 'Whyborne & Griffin', '“I think I will remain here and work on my manuscript,” Christine decided. “Going about talking to the locals sounds dreadfully boring. But if you find you need anyone shot, send word and I’ll come at once.”', 'Dr. Christine Putnam', NULL),
(7, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', '“Don’t sit down just yet, Whyborne,” the director ordered, motioning me to the front of the room. “We’ve a bit of business concerning you before the meeting.”\nI couldn’t possibly imagine what business would concern me. I’d dedicated my entire life to making sure business didn’t concern me whenever possible.', 'Percival Whyborne', NULL),
(8, 'D.N. Bryn', 'How to Bite Your Neighbor and Win a Wager', 'Guides for Dating Vampires', '“I just thought, I don\'t know, that you wouldn\'t want it from me? I\'m kind of pathetic, as vampires go. I don\'t make for a dramatic, mysterious predator. I\'m like the grimy sewer variety of a vampire that you shoo off your lawn with a broom.”', 'Vincent Barnes', NULL),
(9, 'D.N. Bryn', 'How to Bite Your Neighbor and Win a Wager', 'Guides for Dating Vampires', '“You know, this is the first place that’s felt like a home to me in a long time. In forever, really. But since you’ve been gone, it’s just a house again.”', 'Vincent Barnes', NULL),
(10, 'Lisa Henry', 'Adulting 101', NULL, '“I think that when we&#039;re little, they tell us stories about being heroes and saving the universe, and then when we get older, they tell us to grow up and stop believing in dumb stories anymore.”', 'Nick Stahlnecker', NULL),
(11, 'Lisa Henry', 'Adulting 101', NULL, '-- if he happens to have a page in his notebook dedicated entirely to ass-related haikus, that’s his business, right?\nThat ass is so hot. I would totally hit it. Yes yes yes yes yes.', 'Nick Stahlnecker', NULL),
(13, 'Jordan Castillo Price', 'Body and Soul', 'PsyCop', '“This is gonna sound stupid,” I said. Which I can pretty much use to preface anything that comes out of my mouth.', 'Victor Bayne', NULL),
(14, 'Jordan Castillo Price', 'Body and Soul', 'PsyCop', 'I hate dealing with the relatives of the ghosts more than I hate the bleeding, wailing, moaning, intestine-dragging ghosts themselves.', 'Victor Bayne', NULL),
(15, 'Misha Horne', 'Hurt Me, Daddy', 'The Brat &amp; The Beast', 'I could feel him watching me and it made me prickly all over, agitated and itchy like fucking psychological poison ivy.', 'Logan', NULL),
(16, 'Misha Horne', 'Hurt Me, Daddy', 'The Brat &amp; The Beast', '“I don’t like team sports,” he told me. “Or teams. Or sports. Or people. Or…interacting.”\n“Wow. You’re a hell of a good time, aren’t you?”\n“Guess it depends on what you think a good time is.”\nI’d literally never had a good time in my life, but I wasn’t gonna go around saying that, was I?', 'Logan', 'Caleb'),
(17, 'Finn Marlowe', 'Not His Kiss to Take', NULL, 'Jamie arched his back, forced his chest toward those wicked fingers, and promptly lost his already precarious footing.\n“Going somewhere?” Evan asked conversationally.\n“No, I think I’ll hang around for a bit,” he muttered, finding his footing—toeing. Whatever. “See if I might get laid.”\n“There’s always hope. You’re quite an attractive young man.”', 'Jamie', 'Dr. Evan Harrison'),
(18, 'Jordan Castillo Price', 'Criss Cross', 'PsyCop', 'I looked down at the hook. Maurice had squished a worm onto it. A worm spirit didn’t appear and immediately start telling me about the moment of its death, so I presumed I was safe from the spirits of bugs. But then it moved and I realized it was still alive. Gross.', 'Victor Bayne', NULL),
(19, 'Jordan Castillo Price', 'Among the Living', 'PsyCop', 'The homicide was indeed on the border of the Twelfth and Fifth Precincts. It was as if the perp had specifically chosen the very method and location that would bring Marks and me back together in a sea of fumbling awkwardness.', 'Victor Bayne', 'Jacob Marks'),
(20, 'Jordan Castillo Price', 'Among the Living', 'PsyCop', 'I ate as I drove home, wondering how it was that I was queer enough to pick out an avocado wrap, but not queer enough to get cruised at a gay bar.', 'Victor Bayne', NULL),
(21, 'Jordan Castillo Price', 'Quill Me Now', 'The ABCs of Spellcraft', '-- a huge man peeled out from behind a coat rack. Well over six feet tall, shaved head, bulging with muscle and covered in tattoos. The type of guy you’d cross the street to avoid late at night…. Unless you’re into that sort of thing, in which case, he had really striking hazel eyes.', 'Dixon Penn', 'Yuri'),
(22, 'K.J. Charles', 'Unfit to Print', NULL, '“I… Oh, mate. I’d love to share my cat with you.” Gil’s chest felt a bit tight. “But he’s a fleabitten scrapper. He scratches if he thinks you’re going to hurt him, even if you weren’t. He’s a bastard, and you could have any cat you wanted. An easy one. Something sleek and pretty that doesn’t leave a trail of mouse parts. You deserve a better cat than this.”', 'Gil Lawless', NULL),
(23, 'Isabel Murray', 'Gary of a Hundred Days', NULL, 'They wouldn’t be burning this king to ash, I thought grimly as I made my way through the city in a shabby greatcoat and stolen boots. For one thing, good luck lighting a pyre in this weather, even with a barrel of oil. For another, I didn’t plan on sticking around.', 'Gary', NULL),
(24, 'Isabel Murray', 'Gary of a Hundred Days', NULL, '“So...the tongue thing. That’s...that’s normal, yes?”\n“Lots of people like it.”\n“Right. You mean when you do it to them? Or...in general? As in, everyone’s sticking their tongues in each other’s mouths on a regular basis?”\n“Well, I didn’t invent it, Gary. It’s a thing people do.”\n“It is. We do it,” I agreed firmly. “Indeed we do. And obviously I already knew that. What happened was, I was startled because it escalated quickly. I’m ready for it this time.”', 'Gary', 'Magnus'),
(105, 'K.J. Charles', 'Slippery Creatures', 'The Will Darling Adventures', 'And he owned a lot of books, although just now and then, when it got dark and the shelves loomed over him, he got the feeling that they owned him.', 'Will Darling', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
