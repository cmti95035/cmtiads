//
//  ViewController.m
//

#import "ViewController.h"

@implementation ViewController

@synthesize bannerView;

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad {
    
    [super viewDidLoad];
}

- (void)viewDidUnload {
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated {
    [super viewWillAppear:animated];
}

- (void)viewDidAppear:(BOOL)animated {
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated {
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated {
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
    return YES;
}

#pragma mark AdSdk Banner Handling

// Methods used to show how you might slide a banner view in and out

-(BOOL)isBannerViewInHiearchy {
    
    for (UIView *oneView in self.view.subviews) {
        if(oneView == self.bannerView) {
            return YES;
        }
    }
    return NO;
}

- (void)slideOutDidStop:(NSString *)animationID finished:(NSNumber *)finished context:(void *)context {
    [self.bannerView removeFromSuperview];
    self.bannerView.delegate = nil;
    self.bannerView = nil;
}

- (void)slideOutBannerView:(AdSdkBannerView *)banner {
    
    // move banner to below the bottom of screen
    banner.center = CGPointMake(self.view.bounds.size.width/2.0, self.view.bounds.size.height - banner.bounds.size.height/2.0);

    // animate banner outside view
    [UIView beginAnimations:@"AdSdk" context:nil];
    [UIView setAnimationDuration:1];
    [UIView setAnimationDelegate:self];
    [UIView setAnimationDidStopSelector:@selector(slideOutDidStop:finished:context:)];
    banner.transform = CGAffineTransformMakeTranslation(0, banner.bounds.size.height);
    [UIView commitAnimations];
}

- (void)slideInBannerView:(AdSdkBannerView *)banner {
    
    banner.bounds = CGRectMake(0, 0, self.view.bounds.size.width, banner.bounds.size.height);
    
    // move banner to be at bottom of screen
    banner.center = CGPointMake(self.view.bounds.size.width/2.0, self.view.bounds.size.height - banner.bounds.size.height/2.0);
    
    // set transform to be outside of screen
    banner.transform = CGAffineTransformMakeTranslation(0, banner.bounds.size.height);
    
    // animate banner into view
    [UIView beginAnimations:@"AdSdk" context:nil];
    [UIView setAnimationDuration:1];
    banner.transform = CGAffineTransformIdentity;
    [UIView commitAnimations];
}

- (IBAction)requestBannerAdvert:(id)sender {
    
    if (!self.bannerView) {
        
        self.bannerView = [[AdSdkBannerView alloc] initWithFrame:CGRectZero];
        // size does not matter yet
        
        // Don't trigger an Advert load when setting delegate
        self.bannerView.allowDelegateAssigmentToRequestAd = NO;
        
        self.bannerView.delegate = self;
        
        self.bannerView.backgroundColor = [UIColor clearColor];
        self.bannerView.refreshAnimation = UIViewAnimationTransitionFlipFromLeft;
        
        self.bannerView.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleTopMargin;
        
        [self.view addSubview:self.bannerView];
    }

    self.bannerView.requestURL = @"ENTER_REQUEST_URL_HERE";
    
    [self.bannerView requestAd]; // Request a Banner Advert
    
}

#pragma mark AdSdk BannerView Delegate Methods

- (NSString *)publisherIdForAdSdkBannerView:(AdSdkBannerView *)banner {
    return @"ENTER_PUBLISHER_ID_HERE";
}

- (void)adsdkBannerViewDidLoadAdSdkAd:(AdSdkBannerView *)banner {
    NSLog(@"AdSdk Banner: did load ad");
    
    [self slideInBannerView:banner];
}

- (void)adsdkBannerViewDidLoadRefreshedAd:(AdSdkBannerView *)banner {
    NSLog(@"AdSdk Banner: Received a 'refreshed' advert");
    
    if (![self isBannerViewInHiearchy]) {
        
        [self slideInBannerView:banner];
    }
    else {
        
        banner.transform = CGAffineTransformIdentity;
        
        // animate banner into view
        [UIView beginAnimations:@"AdSdk" context:nil];
        [UIView setAnimationDuration:1];
        banner.transform = CGAffineTransformIdentity;
        [UIView commitAnimations];
    }
}

- (void)adsdkBannerView:(AdSdkBannerView *)banner didFailToReceiveAdWithError:(NSError *)error {
    
    NSLog(@"AdSdk Banner: did fail to load ad: %@", [error localizedDescription]);
    
    [self slideOutBannerView:bannerView];
}

@end
