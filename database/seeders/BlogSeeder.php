<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Top 10 Real Estate Investment Tips for 2026',
                'slug' => 'top-10-real-estate-investment-tips-2026',
                'excerpt' => 'Discover the best strategies for real estate investment in 2026. Learn from industry experts about market trends and opportunities.',
                'content' => "Real estate investment continues to be one of the most reliable ways to build wealth. Here are our top 10 tips for 2026:\n\n1. Research the Market: Understanding local market trends is crucial for making informed decisions.\n\n2. Location Matters: Choose properties in areas with strong growth potential and good infrastructure.\n\n3. Diversify Your Portfolio: Don't put all your eggs in one basket. Consider different property types and locations.\n\n4. Calculate ROI Carefully: Factor in all costs including maintenance, taxes, and potential vacancy periods.\n\n5. Consider Long-term Value: Look beyond immediate returns and consider the property's long-term appreciation potential.\n\n6. Work with Professionals: Partner with experienced real estate agents, lawyers, and financial advisors.\n\n7. Stay Updated on Regulations: Keep track of changing property laws and tax regulations.\n\n8. Inspect Thoroughly: Never skip property inspections. Hidden issues can cost you significantly.\n\n9. Plan Your Financing: Secure favorable loan terms and maintain a healthy credit score.\n\n10. Be Patient: Real estate is a long-term investment. Don't rush into decisions.",
                'featured_image' => null,
                'author' => 'Zendo Properties Team',
                'published_date' => Carbon::now()->subDays(5),
                'category' => 'Investment Tips',
                'tags' => 'investment, tips, real estate, 2026',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Understanding the Current Real Estate Market Trends',
                'slug' => 'understanding-current-real-estate-market-trends',
                'excerpt' => 'An in-depth analysis of current market trends and what they mean for buyers and sellers.',
                'content' => "The real estate market is constantly evolving. Here's what you need to know about current trends:\n\nMarket Overview:\nThe market has shown resilience despite economic uncertainties. Property values in prime locations continue to appreciate steadily.\n\nBuyer Trends:\n- Increased demand for sustainable and eco-friendly properties\n- Growing interest in smart home technology\n- Preference for properties with home office spaces\n\nSeller Trends:\n- Competitive pricing strategies\n- Enhanced property staging and presentation\n- Digital marketing becoming essential\n\nFuture Outlook:\nExperts predict continued growth in suburban areas as remote work becomes more common. Urban properties are adapting with mixed-use developments.\n\nConclusion:\nStaying informed about market trends helps you make better real estate decisions whether you're buying, selling, or investing.",
                'featured_image' => null,
                'author' => 'Market Analysis Team',
                'published_date' => Carbon::now()->subDays(10),
                'category' => 'Market Analysis',
                'tags' => 'market trends, analysis, real estate',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'How to Choose the Perfect Property for Your Family',
                'slug' => 'how-to-choose-perfect-property-family',
                'excerpt' => 'A comprehensive guide to finding a home that meets all your family\'s needs and preferences.',
                'content' => "Choosing the right property for your family is one of the most important decisions you'll make. Here's a comprehensive guide:\n\nAssess Your Needs:\n- Number of bedrooms and bathrooms\n- Outdoor space requirements\n- Proximity to schools and workplaces\n- Safety and security features\n\nBudget Considerations:\n- Purchase price\n- Monthly maintenance costs\n- Property taxes\n- Utility expenses\n\nLocation Factors:\n- School district quality\n- Healthcare facilities nearby\n- Shopping and entertainment options\n- Public transportation access\n\nProperty Features:\n- Layout and floor plan\n- Natural lighting\n- Storage space\n- Future expansion possibilities\n\nCommunity Aspects:\n- Neighborhood safety\n- Community amenities\n- Social environment\n- Future development plans\n\nMake a checklist of must-haves versus nice-to-haves to help prioritize your search.",
                'featured_image' => null,
                'author' => 'Home Buying Guide',
                'published_date' => Carbon::now()->subDays(15),
                'category' => 'Buying Guide',
                'tags' => 'family, home buying, property selection',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'The Benefits of Investing in Commercial Real Estate',
                'slug' => 'benefits-investing-commercial-real-estate',
                'excerpt' => 'Explore why commercial real estate can be a lucrative investment opportunity.',
                'content' => "Commercial real estate offers unique advantages for investors:\n\nHigher Income Potential:\nCommercial properties typically generate higher rental income compared to residential properties.\n\nLonger Lease Terms:\nCommercial leases are usually longer (3-10 years), providing stable, predictable income.\n\nProfessional Relationships:\nDealing with business tenants often means more professional interactions and better property maintenance.\n\nTriple Net Leases:\nMany commercial leases are triple net, meaning tenants pay property taxes, insurance, and maintenance.\n\nAppreciation Potential:\nWell-located commercial properties can appreciate significantly over time.\n\nDiversification:\nAdds variety to your investment portfolio beyond residential properties.\n\nTax Benefits:\nVarious tax deductions available for commercial property owners.\n\nConsiderations:\n- Higher initial investment required\n- More complex transactions\n- Market knowledge essential\n- Professional management often needed\n\nCommercial real estate can be an excellent addition to a diversified investment strategy.",
                'featured_image' => null,
                'author' => 'Commercial Division',
                'published_date' => Carbon::now()->subDays(20),
                'category' => 'Commercial Real Estate',
                'tags' => 'commercial, investment, business property',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Upcoming Property Developments in Prime Locations',
                'slug' => 'upcoming-property-developments-prime-locations',
                'excerpt' => 'Get exclusive insights into exciting new property developments coming soon.',
                'content' => "Stay ahead of the curve with information about upcoming developments:\n\nLuxury Residential Projects:\nSeveral high-end residential complexes are planned in premium locations, featuring state-of-the-art amenities and sustainable design.\n\nMixed-Use Developments:\nNew projects combining residential, commercial, and retail spaces are transforming urban landscapes.\n\nSmart City Initiatives:\nTechnology-integrated communities with advanced infrastructure and connectivity.\n\nGreen Buildings:\nEco-friendly developments focusing on sustainability and energy efficiency.\n\nKey Features to Watch:\n- Smart home automation\n- Renewable energy systems\n- Community spaces and parks\n- Advanced security systems\n- High-speed connectivity\n\nInvestment Opportunities:\nEarly investment in these developments can offer significant returns as the areas develop.\n\nTimeline:\nMost projects are expected to complete within 2-3 years, with pre-launch offers available now.\n\nContact us for detailed information about specific projects and investment opportunities.",
                'featured_image' => null,
                'author' => 'Development News',
                'published_date' => Carbon::now()->subDays(3),
                'category' => 'Property News',
                'tags' => 'new developments, upcoming projects, property news',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
